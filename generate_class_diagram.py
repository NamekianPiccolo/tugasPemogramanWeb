import urllib.request
import zlib
import base64

uml = """@startuml
skinparam classAttributeIconSize 0
skinparam monochrome true
skinparam dpi 150

class UserModel {
  + id : INT (PK)
  + username : VARCHAR(100)
  + nama_lengkap : VARCHAR(255)
  + email : VARCHAR(150)
  + password : VARCHAR(255)
  + role : VARCHAR(50)
}

class UnitModel {
  + id : INT (PK)
  + nama_unit : VARCHAR(100)
}

class KategoriModel {
  + id : INT (PK)
  + nama_kategori : VARCHAR(100)
}

class DokumenModel {
  + id : INT (PK)
  + judul : VARCHAR(255)
  + deskripsi : TEXT
  + tanggal : DATE
  + file_dokumen : VARCHAR(255)
  + kategori_id : INT (FK)
  + unit_id : INT (FK)
  + ukuran_file : INT
  + ekstensi_file : VARCHAR(10)
}

class DistribusiModel {
  + id : INT (PK)
  + dokumen_id : INT (FK)
  + user_id : INT (FK)
  + tanggal_pinjam : DATE
  + tanggal_kembali : DATE
  + status : ENUM
}

class RiwayatModel {
  + id : INT (PK)
  + dokumen_id : INT (FK)
  + user_id : INT (FK)
  + aksi : VARCHAR(100)
  + keterangan : TEXT
}

class IzinModel {
  + id : INT (PK)
  + user_id : INT (FK)
  + dokumen_id : INT (FK)
  + pesan : TEXT
  + status_izin : ENUM
  + tgl_pengajuan : DATETIME
}

class RevisiModel {
  + id : INT (PK)
  + dokumen_id : INT (FK)
  + user_id : INT (FK)
  + judul : VARCHAR(255)
  + deskripsi : TEXT
  + tanggal : DATE
  + kategori_id : INT (FK)
  + unit_id : INT (FK)
  + file_dokumen : VARCHAR(255)
  + status_revisi : ENUM
  + pesan_admin : TEXT
  + pesan_revisi : TEXT
}

UserModel "1" -- "*" DokumenModel : mengunggah >
UnitModel "1" -- "*" DokumenModel : menyimpan >
KategoriModel "1" -- "*" DokumenModel : mengkategorikan >
UserModel "1" -- "*" DistribusiModel : meminjam >
DokumenModel "1" -- "*" DistribusiModel : dipinjam >
UserModel "1" -- "*" RiwayatModel : mencatat >
DokumenModel "1" -- "*" RiwayatModel : dicatat >
UserModel "1" -- "*" IzinModel : mengajukan >
DokumenModel "1" -- "*" IzinModel : dimintai izin >
UserModel "1" -- "*" RevisiModel : merevisi >
DokumenModel "1" -- "*" RevisiModel : direvisi >
KategoriModel "1" -- "*" RevisiModel : mengkategorikan >
UnitModel "1" -- "*" RevisiModel : menyimpan >
@enduml"""

def encode_plantuml(text):
    z = zlib.compress(text.encode('utf-8'))[2:-4]
    b = base64.b64encode(z)
    maketrans = bytes.maketrans(
        b'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/',
        b'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_'
    )
    return b.translate(maketrans).decode('utf-8')

url = 'http://www.plantuml.com/plantuml/png/' + encode_plantuml(uml)
req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
try:
    with urllib.request.urlopen(req) as response:
        with open('c:/laragon/www/tugasPemogramanWeb/class_diagram.png', 'wb') as f:
            f.write(response.read())
    print('Class diagram downloaded to class_diagram.png')
except Exception as e:
    print('Error:', e)
