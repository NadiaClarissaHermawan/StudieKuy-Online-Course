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

CREATE TABLE Administrator(
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
	FOREIGN KEY(id_admin) REFERENCES Administrator (id_admin),
	FOREIGN KEY(id_courses) REFERENCES Courses (id_courses)
)

CREATE TABLE Sertifikat(
	id_sertifikat int NOT NULL,
	nama_sertif varchar(255),
	tanggal_perolehan date,
	PRIMARY KEY (id_sertifikat)
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
	FOREIGN KEY(id_admin) REFERENCES Administrator (id_admin)
)

--INSERT BELOW
