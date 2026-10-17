create table prodi(
    id_prodi int not null primary key,
    nama_prodi varchar(100) not null,
    ketua_prodi varchar(100) not null
);

create table mahasiswa(
    nim INT not null primary key,
    nama varchar(50) not null,
    id_prodi int not null,
    jenis_kelamin int not null,
    alamat TEXT not null, 
    constraint fk_mahasiswa_prodi foreign key (id_prodi) references prodi (id_prodi)
);

create table akun(
    id_akun int(6) not null PRIMARY key,
    nim int not null,
    password varchar(10) not null,
    constraint fk_akun_mahasiswa foreign key (nim) references mahasiswa(nim)
);

insert into prodi
values(2001, 'Sistem Informasi Kelautan', 'Willdan Aprizal Arifin, S.Pd., M.Kom.'),
(2002, 'Logistik Kelautan', 'Syifa Fajar Maulani, S.Pd., M.A.B.'),
(2003, 'Pendidikan Kelautan dan Perikanan', 'Ferry Dwi Cahyadi, S.Pd., M.Sc.'),
(2004, 'PGSD', 'Dr. Andika Arisetyawan, M.Si.'),
(2005, 'PGPAUD', 'Dr. Deri Hendriawan, S.Pd., M.Pd.');

insert into mahasiswa
values(2501, 'Ade Rasyah Maulana', 2001, 1, 'jl. Ciracas No.23'),
(2502, 'Zahra Ajeng Kyranti', 2001, 0, 'jl. Lingkar Serang No.25'),
(2503, 'Jordan Arafad', 2002, 1, 'jl. Benggala No.30'),
(2504, 'Nabila Nurfadilah', 2003, 0, 'jl. Cicery No.19'),
(2505, 'Ikhlas Sofikah', 2005, 0, 'jl. Bhineka No.40'),
(2506, 'Abet Ibrahim', 2004, 1, 'jl. Singandaru No.13');

insert into akun
values(123456, 2501, 'Aderasyah2501'),
(234567, 2502, 'Zahra2502'),
(345678, 2503, 'Jordan2503'),
(456789, 2504, 'Nabila2504'),
(567890, 2505, 'Ikhlas2505'),
(678901, 2506, 'Abet2506');