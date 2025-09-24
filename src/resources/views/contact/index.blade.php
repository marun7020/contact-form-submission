@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="{{ route('contact.confirm') }}" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label form__label--required">お名前</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--name">
                    <input type="text" name="first_name" placeholder="例:山田" value="{{ old('first_name', request('first_name')) }}">
                    <input type="text" name="last_name" placeholder="例:太郎" value="{{ old('last_name', request('last_name')) }}">
                </div>
                <div class="form__error">
                    @error('first_name')
                    <p>{{ $message }}</p>
                    @enderror
                    @error('last_name')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label form__label--required">性別</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <label><input type="radio" name="gender" value="1" {{ old('gender', request('gender', 1)) == 1 ? 'checked' : '' }}>男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender', request('gender', 1)) == 2 ? 'checked' : '' }}>女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender', request('gender', 1)) == 3 ? 'checked' : '' }}>その他</label>
                </div>
                <div class="form__error"> 
                    @error('gender')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label form__label--required">メールアドレス</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email', request('email')) }}">
                </div>
                <div class="form__error"> 
                    @error('email')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label form__label--required">電話番号</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--tel">
                    <input type="tel" name="tel[1]" placeholder="080" value="{{ old('tel.1', request('tel.1')) }}">
                    <span>-</span>
                    <input type="tel" name="tel[2]" placeholder="1234" value="{{ old('tel.2', request('tel.2')) }}">
                    <span>-</span>
                    <input type="tel" name="tel[3]" placeholder="5678" value="{{ old('tel.3', request('tel.3')) }}">
                </div>
                <div class="form__error"> 
                    @error('tel')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label form__label--required">住所</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', request('address')) }}">
                </div>
                <div class="form__error"> 
                    @error('address')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building', request('building')) }}">
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label form__label--required">お問い合わせの種類</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--category">
                    <select name="category_id" id="">
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', request('category_id')) == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error"> 
                    @error('category_id')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label form__label--required">お問い合わせ内容</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <textarea name="detail" id="" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', request('detail')) }}</textarea>
                </div>
                <div class="form__error"> 
                    @error('detail')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>

    </form>
</div>
@endsection
