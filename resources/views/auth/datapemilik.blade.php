<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pet Hotel</title>
    <link
      rel="icon"
      type="image/x-icon"
      href="{{ asset('assets/admin-design/admin-design') }}/img/buku sebelas.png"
    />
    <link rel="stylesheet" href="{{ asset('assets/login') }}/style.css" />
  </head>
  <body>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <form
              action="{{ route('register') }}"
              method="POST"
              enctype="multipart/form-data"
              autocomplete="off"
              class="sign-in-form"
            >
              @csrf
              <input type="hidden" name="name" value="{{ $data['name'] }}" />
              <input type="hidden" name="email" value="{{ $data['email'] }}" />
              <input type="hidden" name="password" value="{{ $data['password'] }}" />
              <input
                type="hidden"
                name="password_confirmation"
                value="{{ $data['password_confirmation'] }}"
              />

              <div class="logo">
                <img
                  src="{{ asset('assets/login') }}/img/logo.png"
                  alt="easyclass"
                  style="margin-bottom: 10px"
                />
                <h4>Perpustakaan Sebelas</h4>
              </div>

              <div class="heading">
                <h2>Masukan data pemilik</h2>
              </div>

             

                <div class="input-wrap">
                  <input
                    id="nama"
                    type="text"
                    name="nama"
                    maxlength="12"
                    minlength="4"
                    required
                    placeholder="masukan nama"
                    class="input-field"
                  />
                  <label>{{ __('Nama') }}</label>
                </div>

                <div class="input-wrap">
                  <input
                    id="nomor_telp"
                    type="text"
                    name="nomor_telp"
                    maxlength="12"
                    required
                    placeholder="masukan no telepon"
                    class="input-field"
                  />
                  <label>{{ __('Nomor Telepon') }}</label>
                </div>

                <div class="input-wrap">
                  <select
                    id="jenis_kelamin"
                    name="jenis_kelamin"
                    required
                    class="input-field"
                  >
                    <option value="" selected disabled>
                      Pilih Jenis Kelamin
                    </option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                  <label>{{ __('Jenis Kelamin') }}</label>
                </div>

               
                <div class="input-wrap">
                  <input
                    id="foto"
                    type="file"
                    name="foto"
                    accept="image/*"
                    required
                    placeholder="masukan poto"
                    class="input-field"
                  />
                  <label>{{ __('Foto') }}</label>
                </div>

                <input type="submit" value="{{ __('Register') }}" class="sign-btn" />
              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img
                src="{{ asset('assets/login') }}/img/image1.png"
                class="image img-1 show"
                alt=""
              />
              <img
                src="{{ asset('assets/login') }}/img/image2.png"
                class="image img-2"
                alt=""
              />
              <img
                src="{{ asset('assets/login') }}/img/image3.png"
                class="image img-3"
                alt=""
              />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Create your own courses</h2>
                  <h2>Customize as you like</h2>
                  <h2>Invite students to your class</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript file -->
    <script src="{{ asset('assets/login') }}/app.js"></script>
  </body>
</html>
