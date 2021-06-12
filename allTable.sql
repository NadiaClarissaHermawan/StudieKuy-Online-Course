CREATE TABLE Pengguna (
	id_pengguna int NOT NULL,
	tipe int,
	nama_user varchar(255),
	email varchar(255),
	pass varchar(255),
	PRIMARY KEY (id_pengguna)
)

CREATE TABLE Kota(
	id_kota int NOT NULL,
	nama_kota varchar(255),
	PRIMARY KEY (id_kota)
)

CREATE TABLE Admin(
	id_admin int NOT NULL,
	id_pengguna int NOT NULL,
	PRIMARY KEY(id_admin),
	FOREIGN KEY(id_pengguna) REFERENCES Pengguna (id_pengguna)
)

CREATE TABLE Member(
	id_member int NOT NULL,
	saldo money,
	kontak varchar(255),
	alamat varchar(255),
	id_kota int NOT NULL,
	id_pengguna int NOT NULL,
	PRIMARY KEY(id_member),
	FOREIGN KEY(id_kota) REFERENCES Kota (id_kota),
	FOREIGN KEY(id_pengguna) REFERENCES Pengguna (id_pengguna)
)

CREATE TABLE Pengajar(
	id_pengajar int NOT NULL,
	pendidikan_terakhir varchar(255),
	id_pengguna int NOT NULL
	PRIMARY KEY(id_pengajar),
	FOREIGN KEY(id_pengguna) REFERENCES Pengguna (id_pengguna)
)

CREATE TABLE Sertifikat(
	id_sertifikat int NOT NULL,
	nama_sertif varchar(255),
	tanggal_perolehan date,
	PRIMARY KEY (id_sertifikat)
)

CREATE TABLE Courses(
	id_courses int NOT NULL,
	nama_course varchar(255),
	tarif money,
	soal_ujian varchar(255),
	batas_nilai_minimum int,
	keterangan_course varchar(255),
	id_pengajar int NOT NULL,
	id_sertifikat int NOT NULL,
	PRIMARY KEY(id_courses),
	FOREIGN KEY(id_pengajar) REFERENCES Pengajar (id_pengajar),
	FOREIGN KEY(id_sertifikat) REFERENCES Sertifikat (id_sertifikat)
)


CREATE TABLE Member_Course(
	id_memCourse int NOT NULL,
	nilai_akhir int,
	status_ketuntasan int,
	status_verifikasi int,
	id_member int NOT NULL,
	id_admin int NOT NULL,
	id_courses int NOT NULL,
	PRIMARY KEY(id_memCourse),
	FOREIGN KEY(id_member) REFERENCES Member (id_member),
	FOREIGN KEY(id_admin) REFERENCES Admin (id_admin),
	FOREIGN KEY(id_courses) REFERENCES Courses (id_courses)
)


CREATE TABLE Bidang(
	id_bidang int NOT NULL,
	nama_bidang varchar(255),
	PRIMARY KEY (id_bidang)
)

CREATE TABLE Modul(
	id_modul int NOT NULL,
	isi_modul varchar(255),
	nama_modul varchar(255),
	keterangan_modul varchar(255),
	id_courses int NOT NULL,
	PRIMARY KEY(id_modul),
	FOREIGN KEY(id_courses) REFERENCES Courses (id_courses)
)

CREATE TABLE Bidang_Course(
	id_bidang int NOT NULL,
	id_courses int NOT NULL
	FOREIGN KEY(id_bidang) REFERENCES Bidang (id_bidang),
	FOREIGN KEY(id_courses) REFERENCES Courses (id_courses)
)

CREATE TABLE Transaksi_Course(
	id_transaksi_course int NOT NULL,
	saldo_awal money,
	saldo_akhir money,
	tanggal_transaksi_course date,
	id_courses int NOT NULL,
	id_member int NOT NULL,
	PRIMARY KEY (id_transaksi_course),
	FOREIGN KEY(id_courses) REFERENCES Courses (id_courses),
	FOREIGN KEY(id_member) REFERENCES Member (id_member)
)

CREATE TABLE Transaksi_Saldo(
	id_transaksi_saldo int NOT NULL,
	saldo_awal money,
	saldo_akhir money,
	status_verifikasi int,
	tanggal_transaksi_saldo date,
	nominal_pengisian money,
	id_member int NOT NULL,
	id_admin int NOT NULL,
	PRIMARY KEY (id_transaksi_saldo),
	FOREIGN KEY(id_member) REFERENCES Member (id_member),
	FOREIGN KEY(id_admin) REFERENCES Admin (id_admin)
)

--INSERT BELOW

INSERT INTO Pengguna VALUES
(1, 1, 'Nadia Clarissa', 'nadiaclarissa8@gmail.com', 'nadia123'),
(2, 2, 'Natasha Benedicta', 'tasha123@gmail.com', '123tasha'),
(3, 3, 'Stanislaus Dendrio Evan', 'dendritotak@gmail.com', '12321'),
(4, 2, 'Tasha Boen', 'tasha@gmail.com', '123123'),
(5, 1, 'Clarissa Nadia', 'clanad@gmail.com', '1234567'),
(6, 2, 'Tashaa Bun', 'tashabunda@gmail.com', '123456'),
(7, 3, 'Rioajah', 'rio@gmail.com', '11111'),
(8, 3, 'Dendrit Angkasa', 'dendrit@gmail.com', '12345')

SELECT * 
FROM Pengguna

INSERT INTO Kota VALUES
(1, 'Bandung'),
(2, 'Jakarta'),
(3, 'Lampung'),
(4, 'Tasikmalaya'),
(5, 'Bogor'),
(6, 'Medan')

SELECT * 
FROM Kota

INSERT INTO Admin VALUES
(1, 1),
(2, 5)

SELECT * 
FROM Admin

INSERT INTO Pengajar VALUES
(1, 'Sarjana Komputer', 2),
(2, 'Sarjana Hukum', 4),
(3, 'Sarjana Seni', 6)

SELECT * 
FROM Pengajar

INSERT INTO Member VALUES
(1, 10000, '081234567890', 'Jalan Ciumbeluit 94', 1, 3),
(2, 0, '1234567', 'jalan durian montok', 2, 7),
(3, 50000, '43255', 'jalan cabe rawit', 6, 8)

SELECT * 
FROM Member

INSERT INTO Bidang VALUES
(1, 'Komputer'),
(2, 'Seni'),
(3, 'Hukum'),
(4, 'Science'),
(5, 'Bahasa'),
(6, 'Ekomoni')

SELECT * 
FROM Bidang

INSERT INTO Sertifikat VALUES
(1, 'java basic programming', '2021-06-12'),
(2, 'Melukis Indah', '2021-06-15'),
(3, 'Pengantar Ilmu Hukum', '2021-06-12')

SELECT * 
FROM Sertifikat

INSERT INTO Courses VALUES
(1, 'Java Basic Programming', 50000, 'soalUjian/jbp', 70, 'ini adalah contoh course lorem ipmsumblablabla', 1, 1),
(2, 'Melukis Indah', 20000, 'soalUjiam/mi', 40, 'ini adalah course seni', 3, 2),
(3, 'Pengantar Ilmu Hukum', 30000, 'soalUjian/pih', 60, 'ini adalah course hukum', 2, 3)

SELECT * 
FROM Courses

INSERT INTO Modul VALUES
(1, 'modul/komputer/jbp', 'pengantar java programming', 'ini adalah keterangan', 1),
(2, 'modul/seni/mi', 'melukis indah', 'ini adalah keterangan', 2),
(3, 'modul/hukum/pih', 'pengantar ilmu hukum', 'ini adalah keterangan', 3)

SELECT * 
FROM Modul

INSERT INTO Bidang_Course VALUES
(1, 1),
(2, 2),
(3, 3)

SELECT * 
FROM Bidang_Course

INSERT INTO Member_Course VALUES
(1, -1, 0, 0, 1, 1, 1);

SELECT * 
FROM Member_Course

INSERT INTO Transaksi_Saldo VALUES
(1, 10000, 60000, 0, '2021-06-12', 50000, 1, 1);

SELECT * 
FROM Transaksi_Saldo

INSERT INTO Transaksi_Course VALUES
(1, 60000, 10000, '2021-06-12', 1, 1);

SELECT * 
FROM Transaksi_Course
