# tebak-omega
Versi simplenya akinator untuk game karya angkatan tambahan. Cara kerjanya sama persis kaya akinator, tapi kita cuma ada pilihan "yes" dan "no" karena waktunya mepet dan ngodingnya susah.

# gimana kerjanya?
Kita siapin 20 pertanyaan yang didapet dari survey google form ke omega. (ini katanya ada yang ngurus)
Dari survey yang ada, datanya disimpen gausah pake sql tapi langsung aja di phpnya.
Rencana database:
  Pake array of integer sebanyak 353 elemen.
  Jadi kaya bitmask, tiap bit yang nyala nentuin pertanyaan mana aja yang yes.
Setiap kali jawab pertanyaan, pasti bakal ada kandidat yang tersisih
Dan ini bakal diloop terus sampe dapet 1 kandidat yang unik berdasarkan jawaban-jawaban yang udah dikasih ke player.

Kompleksitasnya n^2, tapi gamasalah karena kita cuma ada 353 kandidat.

# kalo udah beres maunya bakal gimana?
Pas pertama user masuk ke page gamenya, bakal ada page welcome screen gitu, suruh klik untuk mulai gamenya.
Terus, setiap pertanyaan bakal ada satu page sendiri. Isi pagenya ya pertanyaan, tombol yes atau no, sama tombol submit.
Kalo kita udah dapet kandidat yang unik, langsung print siapa itu kandidatnya.
Yang diprint foto, nama, dan udah berapa kali orang ini ditebak.
Terus kalo gaada yang cocok atau orangnya salah, kita minta nama orang yang bener.
Abis itu kita cocokin ke list kita, si player salah masukin data yang mana aja. Karena kita gamungkin salah ^_^

# ngodingnya bakal kaya apa?
Nah itu...
