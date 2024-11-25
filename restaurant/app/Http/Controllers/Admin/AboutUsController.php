<?php

namespace App\Http\Controllers\Admin;

use App\Admin\AboutUs;
use App\Admin\Overview;
use App\Admin\Integrated;
use App\Admin\MissionVision;
use App\Admin\History;
use App\Admin\AroundWorld;
use App\Admin\HealthSafety;
use App\Admin\People;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    const TITLE = "О ресторане";
    const ABOUT_FOLDER = "admin.about";
    const ROUTE = "/admin/about-us";

    const OVERVIEW_FOLDER = "admin.about.overview";
    const HISTORY_FOLDER = "admin.about.history";

    const TITLE_OVERVIEW = "Что они сказали";
    const TITLE_HISTORY = "ИСТОРИЯ";

    const OVERVIEW_ROUTE = "/admin/overview";
    const HISTORY_ROUTE = "/admin/history";

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AboutUs::all();
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::ABOUT_FOLDER . '.index', compact('title', 'route', 'data'));
    }

    /******************** OVERVIEW START ****************/
    public function createOverview()
    {
        $title = self::TITLE_OVERVIEW;
        $route = self::OVERVIEW_ROUTE;
        $action = "Create";
        return view(self::OVERVIEW_FOLDER . '.create', compact('title', 'route', 'action'));
    }

    public function overview()
    {
        $data = Overview::all();
        $title = self::TITLE_OVERVIEW;
        $route = self::OVERVIEW_ROUTE;
        return view(self::OVERVIEW_FOLDER . '.overview', compact('title', 'route', 'data'));
    }

    public function overviewEdit($id)
    {
        $data = Overview::find($id);
        $title = self::TITLE_OVERVIEW;
        $route = self::OVERVIEW_ROUTE;
        $action = "Edit";
        return view(self::OVERVIEW_FOLDER . '.edit', compact('title', 'route', 'action', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function overviewStore(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'title' => 'required|max:191',
            'text1' => 'required|string',
            'path' => 'image'
        ]);

        $overview = new Overview();
        $overview->title = $request->title;
        $overview->text1 = $request->text1;
        $path = '';
        if ($request->path) {
            $path = Storage::disk('public')->putFile('overview', new File($request->path));
        }

        $overview->path = $path;
        $overview->save();

        DB::commit();

        return redirect(self::OVERVIEW_ROUTE);
    }

    public function overviewEditStore(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:191',
            'text1' => 'required|string'
        ]);

        $overview = Overview::find($id);
        $overview->title = $request->title;
        $overview->text1 = $request->text1;

        if ($request->path) {
            Storage::disk('public')->delete($overview->path);
            $path = Storage::disk('public')->putFile('overview', new File($request->path));
            $overview->path = $path;
        }

        $overview->save();

        return redirect(self::OVERVIEW_ROUTE);
    }
    /******************** OVERVIEW END ****************/

    /******************** History START ****************/
    public function history()
    {
        $data = History::all();
        $title = self::TITLE_HISTORY;
        $route = self::HISTORY_ROUTE;
        return view(self::HISTORY_FOLDER . '.history', compact('title', 'route', 'data'));
    }

    public function historyEdit($id)
    {
        $data = History::find($id);
        $title = self::TITLE_HISTORY;
        $route = self::HISTORY_ROUTE;
        $action = "Edit";
        return view(self::HISTORY_FOLDER . '.edit', compact('title', 'route', 'action', 'data'));
    }

    public function historyStore(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:191',
            'description' => 'required|string'
        ]);

        $integrated = History::find($id);
        $integrated->title = $request->title;
        $integrated->description = $request->description;

        $integrated->save();

        return redirect(self::HISTORY_ROUTE);
    }
    /******************** History END ****************/

    public function create()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $action = "Create";
        return view(self::ABOUT_FOLDER . '.create', compact('title', 'route', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:191',
            'description' => 'string',
            'link' => 'string|max:191',
            'path' => 'required|image'
        ]);

        $path = Storage::disk('public')->putFile('about', new File($request->path));

        DB::beginTransaction();

        $about = new AboutUs;
        $about->title = $request->title;
        $about->link = $request->link;
        $about->description = $request->description;
        $about->path = $path;
        $about->save();

        DB::commit();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     * @param \App\Admin\AboutUs $AboutUs
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUs $AboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Admin\AboutUs $AboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = AboutUs::find($id);
        $title = self::TITLE;
        $route = self::ROUTE;
        $action = "Edit";
        return view(self::ABOUT_FOLDER . '.edit', compact('title', 'route', 'action', 'data'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Admin\AboutUs     $AboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:191',
            'description' => 'string',
            'link' => 'string|max:191'
        ]);

        DB::beginTransaction();

        $slider = AboutUs::find($id);
        $slider->title = $request->title;
        $slider->link = $request->link;
        $slider->description = $request->description;
        $slider->link = $request->link;

        if ($request->path) {
            Storage::disk('public')->delete($slider->path);
            $path = Storage::disk('public')->putFile('about', new File($request->path));
            $slider->path = $path;
        }

        $slider->save();

        DB::commit();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Admin\AboutUs $AboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AboutUs::destroy($id);
        return  redirect(self::ROUTE);
    }
    public function destroyOverview($id)
    {
        Overview::destroy($id);
        return  redirect(self::OVERVIEW_ROUTE);
    }
}
