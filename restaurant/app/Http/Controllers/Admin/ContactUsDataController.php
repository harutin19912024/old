<?php

namespace App\Http\Controllers\Admin;

use App\Admin\MediaImage;
use App\helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Admin\ContactUsFormData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContactUsDataController extends Controller
{

    const FOLDER = "admin.contactusdata";
    const TITLE = "Письмо";
    const ROUTE = "/admin/contact-us-data";

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ContactUsFormData::all();
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER . '.index', compact('title', 'route', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $action = "Create";
        return view(self::FOLDER . '.create', compact('title', 'route', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        DB::beginTransaction();

        $media = new ContactUsFormData;
        $media->name = $request->name;
        $media->subject = $request->subject;
        $media->message = $request->message;
        $media->email = $request->email;
        $media->save();
        DB::commit();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ContactUsFormData::find($id);
        $title = self::TITLE;
        $route = self::ROUTE;
        $action = "Show";
        return view(self::FOLDER . '.show', compact('title', 'route', 'data', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MailContent::find($id);
        $title = self::TITLE;
        $route = self::ROUTE;
        $action = "Edit";
        return view(self::FOLDER . '.edit', compact('title', 'route', 'action', 'data'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        DB::beginTransaction();

        $data = ContactUsFormData::find($id);
        $data->name = $request->name;
        $data->subject = $request->subject;
        $data->message = $request->message;
        $data->email = $request->email;
        $data->save();

        DB::commit();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContactUsFormData::destroy($id);
        return redirect(self::ROUTE);
    }
}
