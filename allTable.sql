CREATE TABLE Kota(
	id_kota int NOT NULL,
	nama_kota varchar(255),
	PRIMARY KEY (id_kota)
)

CREATE TABLE Bidang(
	id_bidang int NOT NULL,
	nama_bidang varchar(255),
	PRIMARY KEY (id_bidang)
)

CREATE TABLE Pengguna (
	id_pengguna int NOT NULL,
	tipe int,
	nama_user varchar(255),
	email varchar(255),
	pass varchar(255),
	PRIMARY KEY (id_pengguna)
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

CREATE TABLE Courses(
	id_courses int NOT NULL,
	nama_course varchar(255),
	tarif money,
	soal_ujian varchar(255),
	batas_nilai_minimum int,
	keterangan_course varchar(255),
	id_pengajar int NOT NULL,
	PRIMARY KEY(id_courses),
	FOREIGN KEY(id_pengajar) REFERENCES Pengajar (id_pengajar)
)

CREATE TABLE Sertifikat(
	id_sertifikat int NOT NULL,
	nama_sertif varchar(255),
	id_course int NOT NULL,
	PRIMARY KEY (id_sertifikat),
	FOREIGN KEY (id_course) REFERENCES Courses (id_courses)
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

CREATE TABLE Member_Course(
	id_memCourse int NOT NULL,
	nilai_akhir int,
	status_ketuntasan int NOT NULL,
	tanggal_tuntas date,
	status_verifikasi int,
	id_member int NOT NULL,
	id_admin int,
	id_courses int NOT NULL,
	PRIMARY KEY(id_memCourse),
	FOREIGN KEY(id_member) REFERENCES Member (id_member),
	FOREIGN KEY(id_admin) REFERENCES Admin (id_admin),
	FOREIGN KEY(id_courses) REFERENCES Courses (id_courses)
)


--INSERT BELOW

INSERT INTO Kota VALUES
(1, 'Bandung'),
(2, 'Jakarta'),
(3, 'Lampung'),
(4, 'Tasikmalaya'),
(5, 'Bogor'),
(6, 'Medan'),
(7, 'Bekasi'),
(8, 'Cimahi'),
(9, 'Cianjur'),
(10, 'Denpasar')
SELECT * 
FROM Kota


INSERT INTO Bidang VALUES
(1, 'Computer'),
(2, 'Art'),
(3, 'Law'),
(4, 'Science'),
(5, 'Language'),
(6, 'Economy')
SELECT *
FROM Bidang


INSERT INTO Pengguna VALUES
(1, 1, 'nadia clarissa', 'nadia@gmail.com', 'nadia123'),
(2, 1, 'clarissa nadia', 'clarissa@gmail,com', 'clarissa123'),
(3, 2, 'natasha benedicta', 'natasha@gmail.com', 'natasha123'),
(4, 2, 'tasha boen', 'tasha@gmail.com', 'tasha123'),
(5, 2, 'benedicta', 'benedicta@gmail.com', 'benedicta123'),
(6, 3, 'stanislaus', 'stanislaus@gmail.com', 'stanis123'),
(7, 3, 'rio ajah', 'rio@gmail.com', 'rio123'),
(8, 3, 'dendrio evan', 'evan@gmail.com', 'evan123')
SELECT * 
FROM Pengguna


INSERT INTO Admin VALUES
(1, 1),
(2, 2)
SELECT * 
FROM Admin


INSERT INTO Pengajar VALUES
(1, 'Sarjana Komputer Universitas X', 3),
(2, 'Sarjana Hukum Universitas Y', 4),
(3, 'Sarjana Design & Architecture Universitas Z', 5)
SELECT * 
FROM Pengajar


INSERT INTO Member VALUES
(1, 0, '081111111111', 'Jalan Ciumbuleuit 94', 1, 6),
(2, 10000, '081222222222', 'Jalan Durian Rontok', 2, 7),
(3, 50000, '081333333333', 'Jalan Cabe Rawit No.10', 7, 8)
SELECT * 
FROM Member


INSERT INTO Courses VALUES
(1, 'Java Basic Programming', 50000, 'soalUjian/computer/javaBasicProgramming', 70, 
	'Course ini akan membahas tentang prinsip dasar dan perangkat lunak apa saja yang akan diperlukan dalam 
	melakukan programming dengan bahasa Java.', 1),
(2, 'Design Interior', 20000, 'soalUjian/art/designInterior', 65, 
	'Course ini akan menyajikan beberapa strategi dan contoh design interior yang sedang populer di zaman ini.',3),
(3, 'Pengantar Ilmu Hukum', 50000, 'soalUjian/law/pengantarIlmuHukum', 60, 'Course ini akan membahas beberapa 
	dasar informasi terkait sistematika dan prosedur hukum di Indonesia.', 2)
SELECT * 
FROM Courses


INSERT INTO Sertifikat VALUES
(1, 'java basic programming', 1),
(2, 'Melukis Indah', 2),
(3, 'Pengantar Ilmu Hukum', 3)
SELECT * 
FROM Sertifikat


INSERT INTO Modul VALUES
(1, 'modul/computer/JavaBasicProgramming/part1', 
	'IDE dan kebutuhan dasar sebelum memulai coding Java', 
	'informasi IDE untuk melakukan coding bahasa Java dan persiapan software lainnya'
	, 1),
(2, 'modul/computer/JavaBasicProgramming/part1', 
	'Mengenal fungsi-fungsi dasar pada Java', 
	'fungsi if-else, for, looping scanner dan sebagainya', 1),
(3, 'modul/art/DesignInterior/part1', 'Mengenal Komposisi dan Ruang',
	'akan diajarkan cara mempertimbangkan komposisi benda yang sesuai dan sepadan untuk mengisi ruangan tercinta', 2),
(4, 'modul/art/DesignInterior/part2', 'Membuat design yang cantik',
	'memuat strategi tata letak dan jenis penempatan objek pada ruang', 2),
(5, 'modul/law/PengantarIlmuHukum/part1', 'Mengenali jenis-jenis hukum di Indonesia', 
	'mengingat kembali jenis-jenis hukum yang ada di Indonesia dan kewenangannya', 3),
(6, 'modul/law/PengantarIlmuHukum/part2', 'Proses terbentuknya hukum', 
	'membahas siapa saja yang berhak membuat hukum serta peran tiap pihak yang terlibat', 3),
(7, 'modul/law/PengantarIlmuHukum/part3', 'Alasan mengikuti hukum', 
	'membahas alasan dibentuknya hukum dan mengapa harus ditaati', 3)
SELECT * 
FROM Modul


INSERT INTO Bidang_Course VALUES
(1, 1),
(2, 2),
(3, 3)
SELECT * 
FROM Bidang_Course


INSERT INTO Transaksi_Saldo VALUES
(1, 0, 10000, 1, '2021-06-12', 10000, 2, 1),
(2, 0, 50000, 1, '2021-06-13', 50000, 3, 1),
(3, 10000, 110000, 1, '2021-06-13', 100000, 2, 1);
SELECT * 
FROM Transaksi_Saldo


INSERT INTO Transaksi_Course VALUES
(1, 110000, 60000, '2021-06-13', 1, 2),
(2, 60000, 10000, '2021-06-13', 3, 2);
SELECT * 
FROM Transaksi_Course


INSERT INTO Member_Course VALUES
(1, NULL, 0, NULL, NULL, 2, NULL, 1),
(2, 90, 1, '2021-06-14', 0, 2, 1, 3);
SELECT * 
FROM Member_Course
