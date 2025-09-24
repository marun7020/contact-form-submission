<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller {

    public function index(Request $request) {

        $categories = Category::all();
        
        $data = [
        'first_name'  => $request->input('first_name', ''),
        'last_name'   => $request->input('last_name', ''),
        'gender'      => $request->input('gender', ''),
        'email'       => $request->input('email', ''),
        'tel'         => [
            1 => $request->input('tel.1', ''),
            2 => $request->input('tel.2', ''),
            3 => $request->input('tel.3', ''),
        ],
        'address'     => $request->input('address', ''),
        'building'    => $request->input('building', ''),
        'category_id' => $request->input('category_id', ''),
        'detail'      => $request->input('detail', ''),
    ];

        return view('contact.index', compact('categories', 'data'));
    }

    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();
        $validated['building'] = $validated['building'] ?? '';

        $action = $request->input('action');

        if ($action === 'back') {
            return redirect()->route('contact.index')->withInput($validated);
        }

        if ($action === 'send') {
            $tel = array_filter($validated['tel']);
            $validated['tel'] = implode('-', $tel);

            Contact::create($validated);

            return view('contact.thanks');
        }

        $categories = Category::all();
        return view('contact.confirm', array_merge($validated, ['categories' => $categories]));
    }


    public function send(ContactRequest $request)
    {
        $validated = $request->validated();
        $tel = array_filter($validated['tel']);
        $validated['tel'] = implode('-', $tel);

        Contact::create($validated);

        return view('contact.thanks');
    }

    
}


