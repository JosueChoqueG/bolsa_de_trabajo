<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Publication;
use App\Model\Image;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $events = Publication::title($request->title)->where('type','Evento')->where('status',1)->orderBy('created_at', 'desc')->paginate(6);
        $title = $request->input('title');
        return view('web.publication.evento.index', compact('title','events')); 
    }

    public function event_show(Request $request, $slug)
    {
        $event = Publication::where('slug',$slug)->firstOrFail();
        $images = Image::where('publication_id',$event->id)->get();
        $related_events = Publication::title($event->title)->where('type','Evento')->where('status',1)->where('slug','!=',$event->slug)->orderBy('created_at', 'desc')->limit(5)->get();
        return view('web.publication.evento.show', compact('event', 'related_events','images')); 

    }

    public function articles_interest(Request $request)
    {
        $articles_interest = Publication::title($request->title)->where('type','Artículo de Interés')->where('status',1)->orderBy('created_at', 'desc')->paginate(6);
        $title = $request->input('title');
        return view('web.publication.articles_interest.index', compact('title','articles_interest')); 
    }

    public function articles_interest_show(Request $request, $slug)
    {
        $article_interest = Publication::where('slug',$slug)->firstOrFail();
        $articles_interest = Publication::title($article_interest->title)->where('type','Artículo de Interés')->where('status',1)->where('slug','!=',$article_interest->slug)->orderBy('created_at', 'desc')->limit(5)->get();
        return view('web.publication.articles_interest.show', compact('article_interest', 'articles_interest')); 
    }
}
