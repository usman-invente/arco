<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebsiteBaseController;
use App\News;
use App\Page;
use Illuminate\Http\Request;

class NewsController extends WebsiteBaseController
{
    public function index()
    {
        $news_page=Page::where(['is_menu_bar'=>1,'status_id'=>1,'id'=>2])->first();

        $news=News::where('news.status_id',1)
                ->leftJoin('organizations','news.organization_id','=','organizations.id')
                ->select('news.id','description','organization_id', 'image','news.created_at', 'name_en','name_ar','news.status_id')
                ->orderBy('news.id','DESC')
                ->paginate(6);
        return view('Website.News.index',['news'=>$news,'news_page'=>$news_page]);
    }

    public function details($id)
    {
        $news_page=Page::where(['is_menu_bar'=>1,'status_id'=>1,'id'=>2])->first();

        $news=News::where(['news.id'=>$id,'news.status_id'=>1])
                ->leftJoin('organizations','news.organization_id','=','organizations.id')
                ->select('news.id','description','content','organization_id', 'image','news.created_at', 'name_en','name_ar','logo','news.status_id')
                ->first();
        return view('Website.News.details',compact('news','news_page'));
    }

    public function preview($address)
    {
        
        return view('Website.News.preview');
    }
}
