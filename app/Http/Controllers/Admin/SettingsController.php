<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var Collection $settings */
        $settings = Setting::all();

        /** @var String $title */
        $this->title = "Settings";

        /** @var String $content */
        $content = view('administrator::include.settings')->with(['settings' => $settings, 'title' => $this->title])->render();
        $this->vars = array_add($this->vars, 'content', $content);

        //render output
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id = null)
    {
        /** @var array $data*/
        $data = $request->except('_token','_method');

        /** @var array $fields*/
        $fields = [];
        if($data) {
            foreach ($data as $k=>$field) {

                /** @var Setting $setting*/
                $setting = Setting::where('field',$k)->firstOrFail();

                $value = $field;
                if($setting->type == 'file') {
                    if($request->hasFile($k)) {
                        $value = ImageService::handleUploadedImage(
                            $request->file($k),
                            config('settings.system_photo.width'),
                            config('settings.system_photo.height'),
                            public_path().'/storage/images/settings/'
                        );
                    }
                }
                //setting update
                $setting->fill(
                    [
                        'value'=>$value
                    ]
                )->update();
            }
        }

        // redirect back to page
        return \back()
            ->with(
                [
                    'message' => \trans('admin.settings_update_success_message'),
                    'status' => 'success',
                ]
            );
    }
}
