@extends('components.pengunjungheader')

@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">

    <style>
        .thumb-wrapper {
            position: relative;
            width: 180px;
            height: 180px;
            margin: 0 auto 20px auto;
            cursor: pointer;
            border-radius: 50%;
            overflow: hidden;
        }

        .thumb-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumb-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            font-weight: bold;
            font-size: 18px;
        }

        .thumb-wrapper:hover .thumb-overlay {
            opacity: 1;
        }

        .thumb-input {
            display: none;
        }
    </style>

    <div class="content-header">
        <h1>Profile</h1>
    </div>

    <section class="form-container">
        <form action="{{ route('profile.update.pengunjung') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="thumb-wrapper" onclick="document.getElementById('image').click()">
                <img src="{{ $user->image ? asset('uploaded_profiles/' . $user->image) : asset('assets/images/no-cover.png') }}"
                    alt="Profile Picture" id="thumbPreview">
                <div class="thumb-overlay">Ubah Foto</div>
            </div>
            <input type="file" name="image" id="image" class="thumb-input" accept="image/*"
                onchange="previewThumb(event)">

            <input type="text" name="name" class="form-field" placeholder="Nama"
                value="{{ old('name', $user->name) }}" required />

            <input type="email" name="email" class="form-field" placeholder="Email"
                value="{{ old('email', $user->email) }}" required />

            <input type="text" name="nohp" class="form-field" placeholder="No. Telp"
                value="{{ old('nohp', $user->nohp) }}" required />

            <button type="submit" class="submit-button">Simpan Perubahan</button>
        </form>

        <a href="" style="text-decoration: none;">
            <button type="button" class="submit-button">Ubah Password</button>
        </a>
    </section>

    <script>
        function previewThumb(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('thumbPreview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
