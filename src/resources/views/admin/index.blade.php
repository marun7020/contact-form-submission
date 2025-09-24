@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('button')
<form action="{{ route('logout') }}" class="button-form__content" method="post">
    @csrf
    <div class="logout__button">
        <button class="logout__button-submit">logout</button>
    </div>
</form>
@endsection

@section('content')
<div class="admin-form__content">
    <div class="admin-form__heading">
        <h2>Admin</h2>
    </div>

    <form class="serch-form" action="{{ route('admin.contacts.index') }}" method="get">
            <input  class="serch-form__keyword" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

            <select class="serch-form__gender" name="gender">
                <option value="">性別</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            <select class="serch-form__category" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            <input class="serch-form__date" type="date" name="date" value="{{ request('date') }}">

            <button class="serch-button" type="submit">検索</button>
            <a href="{{ route('admin.contacts.index') }}" class="reset-button">リセット</a>
    </form>

    <div class="serch-form__pagenation">
        <a href="{{ route('admin.contacts.export', request()->query()) }}" class="export-button">エクスポート</a>
        <div class="pagination-wrapper">
            <div class="pagination">
            {{ $contacts->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

    <div class="admin-table">
        <table class="admin-table__inner">
            <thead>
                <tr class="admin-table__header">
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr class="admin-table__text">
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>
                        <button class="detail-button" type="button" onclick="openModal({{ $contact->id }})">詳細</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">該当データはありません</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="modal" id="detailModal">
        <div class="modal__overlay" onclick="closeModal()"></div>
        <div class="modal__content">
            <button class="modal__close" onclick="closeModal()">×</button>
            <div id="modalBody"></div>
        </div>
    </div>
</div>

<script>
function openModal(id) {
    fetch(`/admin/contacts/${id}`)
        .then(res => res.text())
        .then(html => {
            document.getElementById('modalBody').innerHTML = html;
            document.getElementById('detailModal').style.display = 'block';
        });
}

function closeModal() {
    document.getElementById('detailModal').style.display = 'none';
}
</script>
@endsection
