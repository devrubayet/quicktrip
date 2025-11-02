<?php

namespace App\Http\Controllers;

use App\Models\SiteInfo;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
     public function edit()
    {
        $settings = SiteInfo::first(); // id:1, একটাই row ধরে নিলাম
        return view('admin.pages.siteinfo', compact('settings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sitename' => 'required|string|max:255',
            'site_slogan' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'about_us' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'office_phone' => 'nullable|string|max:20',
            'office_mail' => 'nullable|email',
            'notice' => 'nullable|string',
        ]);

        $settings = SiteInfo::findOrFail($id);
        $settings->sitename = $request->sitename;
        $settings->site_slogan = $request->site_slogan;
        $settings->about_us = $request->about_us;
        $settings->phone = $request->phone;
        $settings->office_phone = $request->office_phone;
        $settings->office_mail = $request->office_mail;
        $settings->notice = $request->notice;

        // logo upload handle
        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('settings', 'public');
            $settings->logo = $path;
        }

        $settings->save();

        flash()->success('Settings updated successfully!');
        return redirect()->back();
    }
}
