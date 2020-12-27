<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Mail;
use Validator;

use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;

class Homepage extends Controller
{
    public function __construct()
    {
        view()->share('pages', Page::orderBy('order', 'ASC')->get());
        view()->share('categories', Category::inRandomOrder()->get());

    }

    public function index()
    {
        $data['articles'] = Article::orderBy('created_at', 'DESC')->paginate(2);

        return view('front.homepage', $data);
    }

    public function single($category, $slug)
    {
        $category = Category::whereSlug($category)->first() ?? abort(403, 'Bag işine');
        $article = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403, 'Böyle bir yazı bulunamadı');

        $article->increment('hit'); // sayfaya her girildiğinde 1 artırır
        $data['article'] = $article;

        return view('front.single', $data);
    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403, 'Bag işine');
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id', $category->id)->orderBy('created_at', 'DESC')->paginate(1);

        return view('front.category', $data);
    }

    public function page($slug)
    {
        $page = Page::whereSlug($slug)->first() ?? abort(403, 'Bag işine');
        $data['page'] = $page;

        return view('front.page', $data);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactPost(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required|min:10'
        ];
        $validate = Validator::make($request->post(), $rules);

        if($validate->fails())
        {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        Mail::send([], [], function($message) use($request){
          $message->from('deneme@blogsitesi.com', 'Blog Sitesi Deneme');
          $message->to('inamemrah@gmail.com');
          $message->setBody(
                    'Mesajı Gönderen :' . $request->name . '<br/>
                    Mesajı Gönderen Mail : ' . $request->email . '<br/>
                    Mesaj Konusu : ' . $request->topic . '<br/>
                    Mesaj : ' . $request->message . '<br/>
                    Mesaj Gönderilme Tarihi : ' . now() . '', 'text/html');
          $message->subject($request->name. ' İletişimden mesaj gönderdi');
        });

        /*$contact = new Contact();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->topic = $request->topic;
        $contact->message = $request->message;

        $contact->save();*/

        return redirect()->route('contact')->with('success', 'Mesajınız bize iletildi');
    }
}
