@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')
<div class="confirm-form__content">
    <div class="confirm-form__heading">
        <h2>Confirm</h2>
    </div>

    <form class="form" action="{{ route('contact.confirm') }}" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        {{ $first_name }} {{ $last_name }}
                        <input type="hidden" name="first_name" value="{{ $first_name }}">
                        <input type="hidden" name="last_name" value="{{ $last_name }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        @if($gender == 1) 男性
                        @elseif($gender == 2) 女性
                        @else その他
                        @endif
                        <input type="hidden" name="gender" value="{{ $gender }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        {{ $email }}
                        <input type="hidden" name="email" value="{{ $email }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        {{ $tel[1] }}-{{ $tel[2] }}-{{ $tel[3] }}
                        <input type="hidden" name="tel[1]" value="{{ $tel[1] }}">
                        <input type="hidden" name="tel[2]" value="{{ $tel[2] }}">
                        <input type="hidden" name="tel[3]" value="{{ $tel[3] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        {{ $address }}
                        <input type="hidden" name="address" value="{{ $address }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        {{ $building ?? '' }}
                        <input type="hidden" name="building" value="{{ $building ?? '' }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        {{ $categories->firstWhere('id', $category_id)->content ?? '' }}
                        <input type="hidden" name="category_id" value="{{ $category_id }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        {{ $detail }}
                        <input type="hidden" name="detail" value="{{ $detail }}">
                    </td>
                </tr>
            </table>
        </div>

        <div class="button-wrapper">
            <button class="form__button-submit" type="submit" name="action" value="send">送信</button>

            <button class="form__button-fix" type="submit" name="action" value="back">修正</button>
        </div>
    </form>
</div>
@endsection
