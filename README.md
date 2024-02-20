Cara integrasi Template 

# awal penggunaan 

1.clone repo 
2.composer i
3.npm i
4.npm run dev

# auto reload (dev)
1. comment baris ke 28 , 52-60 di webpack.mix.cjs
2. untuk integrasi auto reload lakukan command npm run watch di terminal

# penambahan plugin 
  # plugin global
    1. untuk plugin global bisa di import di resources/mix/plugins.js
    2. uncomment baris  ke 28,52-60 di webpack.mix.cjs
    3. do npm run dev
  
  # single plugin
    1. (standalone) cara pertama copy file css dan js ke publi/assets/plugins/custom/{nama_lib}
    2. a.(npm way) ,buat folder di resources/vendor/{nama_lib}/index.js dan index.scss , lalu import menggunakan es6 , dan scss import definition
       b. uncomment baris  69-76 di webpack.mix.cjs
       c. npm run dev 