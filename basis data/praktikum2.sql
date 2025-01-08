-- Active: 1722388677378@@localhost@3306@pk2
CREATE DATABASE PK2;

CREATE TABLE gaji(
    id_gaji INT,
    id_karyawan INT,
    bulan INT,
    tahun YEAR,
    jumlah_absensi INT,
    tunjangan DECIMAL(10,2),
    total_gaji DECIMAL(10,2)
);
CREATE TABLE absensi(
    id_absensi INT,
    id_karyawan INT,
    tanggal DATE,
    jam_masuk TIME,
    jam_keluar TIME
);
CREATE TABLE karyawan(
    id_karyawan INT,
    nama VARCHAR(100),
    tanggal_lahir DATE,
    jenis_kelamin ENUM("L", "P"),
    id_jabatan INT
);
CREATE TABLE jabatan(
    id_jabatan INT,
    nama_jabatan VARCHAR(50),
    gaji_pokok DECIMAL(10,2)
);

INSERT INTO karyawan ( id_karyawan, nama, tanggal_lahir, jenis_kelamin, id_jabatan)
VALUES 
(1, 'Ahmad Santoso', '1985-02-10', 'L', 1),
(2, 'Budi Raharjo', '1990-06-15', 'L', 2),
(3, 'Citra Dewi', '1987-08-20', 'P', 3),
(4, 'Dina Kartika', '1992-03-11', 'P', 1),
(5, 'Eko Prasetyo', '1995-05-22', 'L', 2),
(6, 'Fajar Subekti', '1983-10-03', 'L', 3),
(7, 'Galuh Sari', '1988-11-12', 'P', 1),
(8, 'Hendra Wijaya', '1994-04-28', 'L', 2),
(9, 'Indah Susanti', '1991-09-16', 'P', 3),
(10, 'Joko Pramono', '1986-12-05', 'L', 1);

INSERT INTO jabatan ( id_jabatan, nama_jabatan, gaji_pokok)
VALUES 
(1, 'Manager', 8000000.00),
(2, 'Supervisor', 6000000.00),
(3, 'Staff', 4000000.00);


INSERT INTO absensi ( id_absensi, id_karyawan, tanggal, jam_masuk, jam_keluar)
VALUES
(1, 1, '2023-10-01', '08:00', '17:00'),
(2, 2, '2023-10-01', '08:15', '17:05'),
(3, 3, '2023-10-01', '08:10', '17:00'),
(4, 4, '2023-10-01', '08:05', '16:55'),
(5, 5, '2023-10-01', '08:00', '17:00'),
(6, 6, '2023-10-01', '08:10', '17:15'),
(7, 7, '2023-10-01', '08:20', '17:10'),
(8, 8, '2023-10-01', '08:00', '17:05'),
(9, 9, '2023-10-01', '08:25', '17:00'),
(10, 10, '2023-10-01', '08:05', '17:00');

INSERT INTO gaji ( id_gaji, id_karyawan, bulan, tahun, jumlah_absensi, tunjangan, total_gaji)
VALUES 
(1, 1, 10, 2023, 20, 500000, 8500000),
(2, 2, 10, 2023, 19, 450000, 6450000),
(3, 3, 10, 2023, 22, 550000, 4550000),
(4, 4, 10, 2023, 18, 400000, 8400000),
(5, 5, 10, 2023, 20, 500000, 6500000),
(6, 6, 10, 2023, 21, 525000, 4525000),
(7, 7, 10, 2023, 20, 500000, 8500000),
(8, 8, 10, 2023, 19, 475000, 6475000),
(9, 9, 10, 2023, 21, 550000, 4550000),
(10, 10, 10, 2023, 20, 500000, 8500000);

ALTER TABLE gaji
ADD CONSTRAINT PRIMARY KEY (id_gaji);

ALTER TABLE absensi
ADD CONSTRAINT PRIMARY KEY (id_absensi);

ALTER TABLE karyawan
ADD CONSTRAINT PRIMARY KEY (id_karyawan);

ALTER TABLE gaji
ADD CONSTRAINT PRIMARY KEY (id_gaji);

ALTER TABLE jabatan
ADD CONSTRAINT PRIMARY KEY (id_jabatan);

-- 1.
INSERT INTO jabatan ( id_jabatan, nama_jabatan, gaji_pokok)
VALUES 
(4, "Analis", 5000000);

-- 2.
UPDATE karyawan
SET nama = "Budi Santoso"
WHERE id_karyawan = 2; 

-- 3.
DELETE FROM gaji  WHERE id_karyawan = 10 AND bulan = 10 AND tahun = 2023;

-- 4.
SELECT COUNT(*) FROM  karyawan WHERE jenis_kelamin = "L";

-- 5.
SELECT SUM(gaji_pokok) as total_gaji FROM karyawan
LEFT JOIN jabatan on karyawan.id_jabatan = jabatan.id_jabatan
WHERE nama_jabatan = "Supervisor";

-- 6.
SELECT AVG(tunjangan) FROM gaji WHERE bulan = 10 AND tahun = 2023;

-- 7.
SELECT count(karyawan.id_karyawan) FROM karyawan
JOIN absensi ON karyawan.id_karyawan = absensi.id_absensi;

-- 8.
SELECT COUNT(nama) as jenis_kelamin FROM karyawan GROUP BY jenis_kelamin;

-- 9.
SELECT SUM(jabatan.gaji_pokok) FROM jabatan 
JOIN karyawan on jabatan.id_jabatan = karyawan.id_jabatan;

-- 10.
SELECT karyawan.nama,SUM(gaji.total_gaji)
FROM gaji
JOIN karyawan ON absensi.id_karyawan = karyawan.id_karyawan
JOIN absensi ON karyawan.id_karyawan = absensi.id_karyawan;
