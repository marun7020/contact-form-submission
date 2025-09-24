<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        // キーワード検索（名前・メールアドレス）
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"])
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // 性別
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種類
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.show', compact('contact'));
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.contacts.index')->with('success', '削除しました');
    }

    public function export(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
        $query->where(function($q) use ($request) {
            $q->where('last_name', 'like', "%{$request->keyword}%")
              ->orWhere('first_name', 'like', "%{$request->keyword}%")
              ->orWhere('email', 'like', "%{$request->keyword}%");
        });
        }

        if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        $csvData = "\xEF\xBB\xBF"; 
        $csvData .= "名前,性別,電話番号,メールアドレス,種類,詳細\n";
        foreach ($contacts as $contact) {
        $csvData .= "{$contact->last_name} {$contact->first_name},";
        $csvData .= ($contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他')) . ",";
        $csvData .= "{$contact->tel},";
        $csvData .= "{$contact->email},";
        $csvData .= "{$contact->category->content},";
        $csvData .= "{$contact->detail}\n";
        }

        $filename = 'contacts.csv';
        return response($csvData)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename={$filename}");
    }
}
