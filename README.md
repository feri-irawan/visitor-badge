# visitor-badge

Visitor Badge untuk Website atau Github repository, Dibuat dengan ❤ dan PHP native oleh [Saya](https://github.com/feri-irawan)

# Demo Langsung

![Visitor Badge](https://visitor-badges.glitch.me?username=feri-irawan&repo=visitor-badge&style=for-the-badge)

Anda bisa me-refresh halaman ini jika ingin membuktikannya 😄

# Penggunaan

Untuk menggunakannya sangat mudah, Anda hanya perlu melakukannya seperti berikut:

```md
HTML : <img src="https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPO_ID" alt="Visitor Badge" />
Markdown : ![Visitor Badge](https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPO_ID)
```

## Paramter Standar

Parameter ini adalah URL parameter yang dibutuhkan (required)
| Parameter | Deskripsi |
| :-------: | --------- |
| `username` | Diisi dengan username repository github Anda |
| `repo` | Diisi dengan ID atau NAMA repository anda |

## Parameter Opsional

### Menyamakan Angka Visitor Sesuai dengan Views Repository

Jika Anda ingin menyamakan atau melakukan restart angka pada badge menjadi angka dari views yang ada di **Insight > traffic > views** repository Anda.

Maka, Anda perlu menambahkan parameter baru di URL yaitu `token`, yang nilainya adalah **_akses token pribadi_** Anda, oleh karena itu Anda perlu membuat _akses token pribadi_, Caranya silahkan baca di [Creating a personal access token](https://docs.github.com/en/github/authenticating-to-github/keeping-your-account-and-data-secure/creating-a-personal-access-token)

> **Info:** <br> Untuk langkah ke-8 yang ada dipanduan [Creating a personal access token](https://docs.github.com/en/github/authenticating-to-github/keeping-your-account-and-data-secure/creating-a-personal-access-token), anda hanya perlu mencentang 1 permission yaitu `public_repo`

**Contoh Penggunaan Token :**

```md
![Visitor Badge](https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPOSITORY&token=YOUR_PERSONAL_ACCESS_TOKEN)
```

### Tipe Konten

Secara default badge yang dikembalikan adalah sebuah gambar PNG yang bisa saja buram, oleh karena itu, untuk saat ini telah disediakan tipe konten kedua yaitu SVG. Bagaimana mengatur tipe konten?

Untuk mengatur tipe konten Anda hanya perlu menambah parameter baru di URL, yaitu `contentType`.

**Contoh Penggunaan ContentType :**

```md
![Visitor Badge](https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPOSITORY&contentType=svg)
```

> **Info:** <br> Jika tipe konten yang Anda masukan tidak ada dalam daftar tipe konten yang di sediakan, maka secara default tipe konten yang akan diberikan kembali ke tipe konten PNG

### Tampilan

Berikut adalah daftar parameter untuk mengatur tampilan badge
| Paramter | Deskripsi |
| :------: | --------- |
| `label` | Ini untuk mengganti label default (VISITOR) dengan label lain |
| `color` | Ini untuk mengganti warna badge, anda bisa menggunakan nama warna (bahasa inggris), kode HEX, RGB, HSL |
| `style` | Ini untuk tampilan badge, untuk info lebih lanjut silahkan lihat style pada [shield.io](https://shield.io) |
| `logo` | Jika anda ingin memberi logo, anda bisa lihat daftar logo di [simple-icons](https://github.com/simple-icons/simple-icons/blob/develop/slugs.md)

## Contoh Kustomisasi

### Label

```md
Label : VIEWS
![Visitor Badge](https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPOSITORY&style=for-the-badge&label=VIEWS)

Label : PENGUNJUNG
![Visitor Badge](https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPOSITORY&style=for-the-badge&label=PENGUNJUNG)
```

### Color

```md
Name : ![Visitor Badge](https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPOSITORY&color=red)
HEX : ![Visitor Badge](https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPOSITORY&color=#e05d44)
RGB : ![Visitor Badge](https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPOSITORY&color=rgb%28224%2C+93%2C+68%29)
HSL : ![Visitor Badge](https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPOSITORY&color=hsl%2810%2C+72%25%2C+57%25%29)
```

> Info: <br />
> Untuk penggunaan warna RGB dan HSL pada _markdown_ maka Anda perlu melakukan _url encode_

### Style

```md
![Visitor Badge](https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPOSITORY&style=STYLE_NAME)
```

Untuk nama gaya silahkan lihat daftar gaya pada [shield.io](https://shield.io)

### Logo

```md
![Visitor Badge](https://visitor-badges.glitch.me?username=YOUR_USERNAME&repo=YOUR_REPOSITORY&logo=LOGO_NAME)
```

Untuk nama logo, silahkan lihat daftar logo yang di sediakan oleh [simple-icons](https://github.com/simple-icons/simple-icons/blob/develop/slugs.md)

# Dukungan

Dukung projek ini.

[![Saweria](https://img.shields.io/badge/-SAWERIA-orange?style=for-the-badge)](https://saweria.co/feriirawans)

Semoga bermanfaat, terima kasih.
