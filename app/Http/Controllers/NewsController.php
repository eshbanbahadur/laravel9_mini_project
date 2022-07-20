<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewsCreated;
use DB;
use App\Models\User;
use Auth;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news =  DB::table('news')->orderBy('id', 'desc')->get();
        return view('news.show',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('here');
        return view('news\create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $newsdetails = new \App\Models\News;
        $newsdetails->title = $request['title'];
        $newsdetails->content = $request->content;
        $newsdetails->user_id = Auth::user()->id;;
        $newsdetails->save();
         // Dispatch event
        event(new NewsCreated($newsdetails));
        NewsCreated::dispatch($newsdetails);

        return redirect('/news')->with('success', 'News added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($news_id)
    {
        $news = \App\Models\News::Where('id',$news_id)->first();
        return view("news.edit",["news" =>  $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request['news_id'];
        $news=DB::table('news')->where('id',$id)->get();
        $title=$request['title'];
        $content=$request->content;
        DB::update('update news set title = ? , content = ? where id = ?',[$title,$content,$id]);
        //session()->flash("success", "News updated successfully");
        return redirect('/news')->with('success', 'News updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($news_id)
    {
        $news = \App\Models\News::Where('id',$news_id);
        $news->delete();
        return redirect('/news')->with('success', 'News deleted successfully');
    }
}
