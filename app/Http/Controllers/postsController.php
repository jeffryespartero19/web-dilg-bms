<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;


class postsController extends Controller
{
    //Newsfeed New Post
    public function createPost(Request $request)
    {
        $data = array(
            'Encoder_ID'       => Auth::user()->id,
            'Date_Published'   => Carbon::now(),
            'Date_Stamp'       => Carbon::now(),
            'News_Title'       => $request['postTitle'],
            'News_Description' => $request['postActual'],
            'News_Type_ID'     => $request['postType'],
            'News_Status_ID'   => $request['postStatus']
        );

        $post_id = DB::table('brgy_website_news')->insertGetId($data);

        $file_valid = $this->validate($request, [
            'FUpload' => 'mimes:doc,docx,odf,pdf,xlxs,txt,odt,ppt',
            'imgUpload'  => 'mimes:jpeg,png,jpg,svg',
            'vidUpload'  => 'mimes:avi,flv,mp4,wmv,mkv,3gp,mov,webm',
            'gifUpload'  => 'mimes:gif',
        ]);

        if ($file_valid) {
            if ($request['up1_only'] == 'file') {
                $image = $request->file('FUpload');
                $name = 'file' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/uploads/fileX');
                $image->move($destinationPath, $name);

                $att_data=array(
                    'News_ID'        => $post_id,
                    'File_Name'      => $name,
                    'File_Location'  => $destinationPath,
                    'File_Type'      => 'File',
                    'Date_Stamp'     => Carbon::now(),
                    'Encoder_ID'     => Auth::user()->id
                );

                DB::table('brgy_website_file_attachement')->insert($att_data);

            }
            if ($request['up1_only'] == 'image') {
                $image = $request->file('imgUpload');
                $name = 'image' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/uploads/imgX');
                $image->move($destinationPath, $name);

                $att_data=array(
                    'News_ID'        => $post_id,
                    'File_Name'      => $name,
                    'File_Location'  => $destinationPath,
                    'File_Type'      => 'Image',
                    'Date_Stamp'     => Carbon::now(),
                    'Encoder_ID'     => Auth::user()->id
                );

                DB::table('brgy_website_file_attachement')->insert($att_data);
            }
            if ($request['up1_only'] == 'video') {
                $image = $request->file('vidUpload');
                $name = 'video' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/uploads/videoX');
                $image->move($destinationPath, $name);

                $att_data=array(
                    'News_ID'        => $post_id,
                    'File_Name'      => $name,
                    'File_Location'  => $destinationPath,
                    'File_Type'      => 'Video',
                    'Date_Stamp'     => Carbon::now(),
                    'Encoder_ID'     => Auth::user()->id
                );

                DB::table('brgy_website_file_attachement')->insert($att_data);
            }
            if ($request['up1_only'] == 'gif') {
                $image = $request->file('gifUpload');
                $name = 'image' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/uploads/gifX');
                $image->move($destinationPath, $name);

                $att_data=array(
                    'News_ID'        => $post_id,
                    'File_Name'      => $name,
                    'File_Location'  => $destinationPath,
                    'File_Type'      => 'GIF',
                    'Date_Stamp'     => Carbon::now(),
                    'Encoder_ID'     => Auth::user()->id
                );

                DB::table('brgy_website_file_attachement')->insert($att_data);
            }
        }
        return redirect()->back();
    }

    public function createAnnouncement(Request $request)
    {
        $data = array(
            'Encoder_ID'                 => Auth::user()->id,
            'Date_Published'             => Carbon::now(),
            'Date_Stamp'                 => Carbon::now(),
            'Announcement_Title'         => $request['annTitle'],
            'Announcement_Description'   => $request['annActual'],
            'Announcement_Type'          => $request['annType'],
            'Announcement_Status_ID'     => $request['annStatus']
        );

        $post_id = DB::table('brgy_website_announcement')->insertGetId($data);

        $file_valid = $this->validate($request, [
            'FUpload2' => 'mimes:doc,docx,odf,pdf,xlxs,txt,odt,ppt',
            'imgUpload2'  => 'mimes:jpeg,png,jpg,svg',
            'vidUpload2'  => 'mimes:avi,flv,mp4,wmv,mkv,3gp,mov,webm',
            'gifUpload2'  => 'mimes:gif',
        ]);

        if ($file_valid) {
            if ($request['up1_only2'] == 'file') {
                $image = $request->file('FUpload2');
                $name = 'file' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/uploads/fileX');
                $image->move($destinationPath, $name);

                $att_data=array(
                    'Announcement_ID'=> $post_id,
                    'File_Name'      => $name,
                    'File_Location'  => $destinationPath,
                    'File_Type'      => 'File',
                    'Date_Stamp'     => Carbon::now(),
                    'Encoder_ID'     => Auth::user()->id
                );

                DB::table('brgy_website_file_attachement')->insert($att_data);

            }
            if ($request['up1_only2'] == 'image') {
                $image = $request->file('imgUpload2');
                $name = 'image' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/uploads/imgX');
                $image->move($destinationPath, $name);

                $att_data=array(
                    'Announcement_ID'=> $post_id,
                    'File_Name'      => $name,
                    'File_Location'  => $destinationPath,
                    'File_Type'      => 'Image',
                    'Date_Stamp'     => Carbon::now(),
                    'Encoder_ID'     => Auth::user()->id
                );

                DB::table('brgy_website_file_attachement')->insert($att_data);
            }
            if ($request['up1_only2'] == 'video') {
                $image = $request->file('vidUpload2');
                $name = 'video' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/uploads/videoX');
                $image->move($destinationPath, $name);

                $att_data=array(
                    'Announcement_ID'=> $post_id,
                    'File_Name'      => $name,
                    'File_Location'  => $destinationPath,
                    'File_Type'      => 'Video',
                    'Date_Stamp'     => Carbon::now(),
                    'Encoder_ID'     => Auth::user()->id
                );

                DB::table('brgy_website_file_attachement')->insert($att_data);
            }
            if ($request['up1_only2'] == 'gif') {
                $image = $request->file('gifUpload2');
                $name = 'image' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/uploads/gifX');
                $image->move($destinationPath, $name);

                $att_data=array(
                    'Announcement_ID'=> $post_id,
                    'File_Name'      => $name,
                    'File_Location'  => $destinationPath,
                    'File_Type'      => 'GIF',
                    'Date_Stamp'     => Carbon::now(),
                    'Encoder_ID'     => Auth::user()->id
                );

                DB::table('brgy_website_file_attachement')->insert($att_data);
            }
        }
        return redirect()->back();
    }

}
