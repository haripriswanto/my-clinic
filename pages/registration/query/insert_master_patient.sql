INSERT INTO tb_master_patient(id, mr, no_identitas, nama_lengkap, nama_keluarga, title, status, ket_gender, kode_gender, id_gender, tempat_lhir, tgl_lahir, alamat_lengkap, alamat, no_rumah, no_blok, blok, nama_desa, kode_desa, id_desa, kecamatan, kode_kecamatan, id_kecamatan, kabupaten, kode_kabupaten, id_kabupaten, provinsi, kode_provinsi, id_provinsi, kota, kode_kota, id_kota, kode_pos, no_hp, no_telp, email_pribadi, telp_kantor, ket_suku, kode_suku, id_suku, ket_gelar_pendidikan, kode_gelar_pendidikan, id_gelar_pendidikan, jabatan, ket_agama, kode_agama, id_agama, nama_ayah, no_identitas_ayah, alamat_ayah, telp_ayah, nama_ibu, no_identitas_ibu, alamat_ibu, telp_ibu, emergency_person, emergency_person_relation, emergency_address, emergency_phone, ket_status_menikah, kode_status_menikah, id_status_menikah, nama_pasangan, golongan_darah, golongan_darah_resus, nama_perusahaan, kode_perusahaan, id_perusahaan, no_pegawai, id_pegawai, department_pegawai, jabatan_pegawai, nama_asuransi, kode_asuransi, id_asuransi, no_asuransi, berlaku_sampai, kategori_cara_bayar, kode_kategori_cara_bayar, id_kategori_cara_bayar, ket_tagihan, kode_tagihan, id_tagihan, status_rujukan, referal_in_type, asal_rujukan, tgl_rujukan_masuk, waktu_rujukan_masuk, diagnosa_saat_rujukan_masuk, kondisi_saat_rujukan_masuk, status_darurat, tgl_masuk, waktu_masuk, nama_department, kode_department, id_department, no_antrian, nama_dokter, kode_dokter, id_dokter, ket_tipe_pasien, kode_tipe_pasien, id_tipe_pasien, ket_diagnose, icds_diagnose, kode_diagnose, tipe_rujukan_keluar, tujuan_rujukan_keluar, no_rujukan_keluar, tgl_rujukan_keluar, ket_diagnose_rujukan_keluar, icds_rujukan_keluar, kode_dpjp, id_dpjp, kondisi_rujukan_keluar, date_insert, time_insert, ts_insert, ts_update, is_active, ip_address, user_name) 

VALUES ('$id', '$mr', '$no_identitas', '$nama_lengkap', '$nama_keluarga', '$title', '$status', '$ket_gender', '$kode_gender', '$id_gender', '$tempat_lhir', '$tgl_lahir', '$alamat_lengkap', '$alamat', '$no_rumah', '$no_blok', '$blok', '$nama_desa', '$kode_desa', '$id_desa', '$kecamatan', '$kode_kecamatan', '$id_kecamatan', '$kabupaten', '$kode_kabupaten', '$id_kabupaten', '$provinsi', '$kode_provinsi', '$id_provinsi', '$kota', '$kode_kota', '$id_kota', '$kode_pos', '$no_hp', '$no_telp', '$email_pribadi', '$telp_kantor', '$ket_suku', '$kode_suku', '$id_suku', '$ket_gelar_pendidikan', '$kode_gelar_pendidikan', '$id_gelar_pendidikan', '$jabatan', '$ket_agama', '$kode_agama', '$id_agama', '$nama_ayah', '$no_identitas_ayah', '$alamat_ayah', '$telp_ayah', '$nama_ibu', '$no_identitas_ibu', '$alamat_ibu', '$telp_ibu', '$emergency_person', '$emergency_person_relation', '$emergency_address', '$emergency_phone', '$ket_status_menikah', '$kode_status_menikah', '$id_status_menikah', '$nama_pasangan', '$golongan_darah', '$golongan_darah_resus', '$nama_perusahaan', '$kode_perusahaan', '$id_perusahaan', '$no_pegawai', '$id_pegawai', '$department_pegawai', '$jabatan_pegawai', '$nama_asuransi', '$kode_asuransi', '$id_asuransi', '$no_asuransi', '$berlaku_sampai', '$kategori_cara_bayar', '$kode_kategori_cara_bayar', '$id_kategori_cara_bayar', '$ket_tagihan', '$kode_tagihan', '$id_tagihan', '$status_rujukan', '$referal_in_type', '$asal_rujukan', '$tgl_rujukan_masuk', '$waktu_rujukan_masuk', '$diagnosa_saat_rujukan_masuk', '$kondisi_saat_rujukan_masuk', '$status_darurat', '$tgl_masuk', '$waktu_masuk', '$nama_department', '$kode_department', '$id_department', '$no_antrian', '$nama_dokter', '$kode_dokter', '$id_dokter', '$ket_tipe_pasien', '$kode_tipe_pasien', '$id_tipe_pasien', '$ket_diagnose', '$icds_diagnose', '$kode_diagnose', '$tipe_rujukan_keluar', '$tujuan_rujukan_keluar', '$no_rujukan_keluar', '$tgl_rujukan_keluar', '$ket_diagnose_rujukan_keluar', '$icds_rujukan_keluar', '$kode_dpjp', '$id_dpjp', '$kondisi_rujukan_keluar', '$date_insert', '$time_insert', '$ts_insert', '$ts_update', '$is_active', '$ip_address', '$user_name');


CREATE TABLE tb_patient_active
(
  id varchar(50) NOT NULL,
  journal_id varchar(50),
  journal_department_name varchar(250),
  journal_department_code varchar(80),
  journal_department_id varchar(50),
  patient_id varchar(50),
  mr varchar(50),
  identity_number varchar(50),
  person_id varchar(50),
  full_name varchar(250),
  family_name varchar(250),
  title_name varchar(250),
  state_as varchar(250),
  gender_description varchar(50),
  gender smallint DEFAULT 0,
  gender_id varchar(50),
  place_of_birth varchar(50),
  date_of_birth date,
  age bigint,
  full_address varchar(250),
  url_map varchar(250),
  house_number varchar(50),
  block_number varchar(50),
  block_area varchar(50),
  city varchar(50),
  village varchar(250),
  village_code varchar(250),
  village_id varchar(50),
  sub_district varchar(250),
  sub_district_code varchar(250),
  sub_district_id varchar(50),
  district varchar(250),
  district_code varchar(250),
  district_id varchar(50),
  province varchar(50),
  province_code varchar(50),
  province_id varchar(50),
  country varchar(50),
  country_code varchar(50),
  country_id varchar(50),
  postal varchar(50),
  category_area smallint DEFAULT 0,
  mobile_phone varchar(250),
  home_phone varchar(250),
  personal_email varchar(250),
  office_phone varchar(250),
  official_email varchar(250),
  ethnic_description varchar(50),
  ethnic_code varchar(50),
  ethnic_id varchar(50),
  education_degree_description varchar(250),
  education_degree_code varchar(50),
  education_degree_id varchar(50),
  occupation varchar(50),
  religion_description varchar(50),
  religion_code varchar(50),
  religion_id varchar(50),
  father_name varchar(250),
  father_identity_number varchar(128),
  father_person_id varchar(50),
  father_id varchar(50),
  father_address varchar(250),
  father_phone varchar(250),
  mother_name varchar(250),
  mother_identity_number varchar(128),
  mother_person_id varchar(50),
  mother_id varchar(50),
  mother_address varchar(250),
  mother_phone varchar(250),
  emergency_person varchar(250),
  emergency_person_relation varchar(250),
  emergency_address varchar(250),
  emergency_phone varchar(250),
  marital_state_description varchar(50),
  marital_state smallint DEFAULT 0,
  marital_state_id varchar(50),
  pair_name varchar(250),
  blood_group varchar(50),
  blood_rhesus varchar(50),
  company_name varchar(128),
  company_code varchar(50),
  company_id varchar(50),
  employee_number varchar(50),
  employee_id varchar(50),
  department_of_employee varchar(250),
  position_of_employee varchar(50),
  insurance_name varchar(50),
  insurance_code varchar(50),
  insurance_id varchar(50),
  insurance_number varchar(50),
  valid_until date,
  bill_category_description varchar(50),
  bill_category smallint,
  bill_category_id varchar(50),
  filter_contract varchar(128),
  bill_description varchar(50),
  bill_code varchar(50),
  bill_id varchar(50),
  service_description varchar(50),
  service_code varchar(50),
  service_id varchar(50),
  warranty_number varchar(250),
  bill_third_party_amount numeric,
  bill_third_party_paid numeric,
  bill_personal_amount numeric,
  bill_personal_paid numeric,
  payment_polecy varchar(128),
  cash_paid numeric,
  cash_back numeric,
  is_referal smallint,
  referal_required_list varchar(250),
  referal_in_type varchar(250),
  referal_in_from varchar(250),
  referal_in_letter_number varchar(250),
  referal_in_date date,
  referal_in_diagnose varchar(250),
  physical_state_in varchar(250),
  physical_state_in_description varchar(250),
  emergency_state varchar(250),
  competency varchar(250),
  competency_code varchar(250),
  competency_id varchar(82),
  nursing_start_date date,
  nursing_start_time time without time zone,
  nursing_end_date date,
  nursing_end_time time without time zone,
  nursing_type_description varchar(250),
  nursing_type smallint,
  department_name varchar(50),
  department_code varchar(50),
  department_id varchar(50),
  is_general_practitioner varchar(1),
  is_consult varchar(1),
  is_consult_nutritionist varchar(1),
  contract_class_name varchar(50),
  contract_class_code varchar(50),
  contract_class_id varchar(50),
  present_class_name varchar(50),
  present_class_code varchar(50),
  present_class_id varchar(50),
  nursing_bed_name varchar(50),
  nursing_bed_code varchar(50),
  nursing_bed_id varchar(50),
  patient_nursing_bed_id varchar(50),
  nursing_bed_start_date date,
  nursing_bed_start_time time without time zone,
  nursing_bed_end_date date,
  nursing_bed_end_time time without time zone,
  diet_menu varchar(250),
  queue_number smallint,
  dokter_name varchar(50),
  dokter_code varchar(50),
  dokter_id varchar(50),
  pasien_type_description varchar(50),
  pasien_type smallint,
  pasien_type_id varchar(50),
  diagnose_descriptions varchar(250),
  diagnose_icds varchar(250),
  diagnose_codes varchar(250),
  referal_out_type varchar(250),
  referal_out_to varchar(250),
  referal_out_letter_number varchar(250),
  referal_out_reason varchar(250),
  referal_out_date date,
  referal_out_time time without time zone,
  referal_out_diagnose_descriptions varchar(250),
  referal_out_diagnose_icds varchar(250),
  referal_out_by_dokter varchar(250),
  referal_out_by_dokter_id varchar(250),
  physical_state_out varchar(250),
  physical_state_out_description varchar(250),
  is_death smallint,
  death_date date,
  death_time time without time zone,
  death_causa varchar(250),
  death_of_diagnose_descriptions varchar(250),
  death_of_diagnose_icds varchar(250),
  medical_record_service_description varchar(255),
  medical_record_service_email varchar(255),
  medical_record_service_password varchar(255),
  medical_record_service_login_name varchar(255),
  medical_record_service_url varchar(250),
  medical_record_service_category varchar(128),
  medical_record_service_id varchar(128),
  queue integer,
  queue_registration_number integer,
  queue_registration_date date,
  queue_registration_time time without time zone,
  ts_insert timestamp without time zone DEFAULT now(),
  ts_update timestamp without time zone DEFAULT now(),
  bl_state varchar(1) DEFAULT 'A'::varchar,
  ac_conn varchar(50),
  ac_user varchar(50)
  payment_validate smallint
)


$id = $row['id'];
$mr = $row['mr'];
$no_identitas = $row['no_identitas'];
$nama_lengkap = $row['nama_lengkap'];
$nama_keluarga = $row['nama_keluarga'];
$title = $row['title'];
$status = $row['status'];
$ket_gender = $row['ket_gender'];
$kode_gender = $row['kode_gender'];
$id_gender = $row['id_gender'];
$tempat_lhir = $row['tempat_lhir'];
$tgl_lahir = $row['tgl_lahir'];
$alamat_lengkap = $row['alamat_lengkap'];
$alamat = $row['alamat'];
$no_rumah = $row['no_rumah'];
$no_blok = $row['no_blok'];
$blok = $row['blok'];
$nama_desa = $row['nama_desa'];
$kode_desa = $row['kode_desa'];
$id_desa = $row['id_desa'];
$kecamatan = $row['kecamatan'];
$kode_kecamatan = $row['kode_kecamatan'];
$id_kecamatan = $row['id_kecamatan'];
$kabupaten = $row['kabupaten'];
$kode_kabupaten = $row['kode_kabupaten'];
$id_kabupaten = $row['id_kabupaten'];
$provinsi = $row['provinsi'];
$kode_provinsi = $row['kode_provinsi'];
$id_provinsi = $row['id_provinsi'];
$kota = $row['kota'];
$kode_kota = $row['kode_kota'];
$id_kota = $row['id_kota'];
$kode_pos = $row['kode_pos'];
$no_hp = $row['no_hp'];
$no_telp = $row['no_telp'];
$email_pribadi = $row['email_pribadi'];
$telp_kantor = $row['telp_kantor'];
$ket_suku = $row['ket_suku'];
$kode_suku = $row['kode_suku'];
$id_suku = $row['id_suku'];
$ket_gelar_pendidikan = $row['ket_gelar_pendidikan'];
$kode_gelar_pendidikan = $row['kode_gelar_pendidikan'];
$id_gelar_pendidikan = $row['id_gelar_pendidikan'];
$jabatan = $row['jabatan'];
$ket_agama = $row['ket_agama'];
$kode_agama = $row['kode_agama'];
$id_agama = $row['id_agama'];
$nama_ayah = $row['nama_ayah'];
$no_identitas_ayah = $row['no_identitas_ayah'];
$alamat_ayah = $row['alamat_ayah'];
$telp_ayah = $row['telp_ayah'];
$nama_ibu = $row['nama_ibu'];
$no_identitas_ibu = $row['no_identitas_ibu'];
$alamat_ibu = $row['alamat_ibu'];
$telp_ibu = $row['telp_ibu'];
$emergency_person = $row['emergency_person'];
$emergency_person_relation = $row['emergency_person_relation'];
$emergency_address = $row['emergency_address'];
$emergency_phone = $row['emergency_phone'];
$ket_status_menikah = $row['ket_status_menikah'];
$kode_status_menikah = $row['kode_status_menikah'];
$id_status_menikah = $row['id_status_menikah'];
$nama_pasangan = $row['nama_pasangan'];
$golongan_darah = $row['golongan_darah'];
$golongan_darah_resus = $row['golongan_darah_resus'];
$nama_perusahaan = $row['nama_perusahaan'];
$kode_perusahaan = $row['kode_perusahaan'];
$id_perusahaan = $row['id_perusahaan'];
$no_pegawai = $row['no_pegawai'];
$id_pegawai = $row['id_pegawai'];
$department_pegawai = $row['department_pegawai'];
$jabatan_pegawai = $row['jabatan_pegawai'];
$nama_asuransi = $row['nama_asuransi'];
$kode_asuransi = $row['kode_asuransi'];
$id_asuransi = $row['id_asuransi'];
$no_asuransi = $row['no_asuransi'];
$berlaku_sampai = $row['berlaku_sampai'];
$kategori_cara_bayar = $row['kategori_cara_bayar'];
$kode_kategori_cara_bayar = $row['kode_kategori_cara_bayar'];
$id_kategori_cara_bayar = $row['id_kategori_cara_bayar'];
$ket_tagihan = $row['ket_tagihan'];
$kode_tagihan = $row['kode_tagihan'];
$id_tagihan = $row['id_tagihan'];
$status_rujukan = $row['status_rujukan'];
$referal_in_type = $row['referal_in_type'];
$asal_rujukan = $row['asal_rujukan'];
$tgl_rujukan_masuk = $row['tgl_rujukan_masuk'];
$waktu_rujukan_masuk = $row['waktu_rujukan_masuk'];
$diagnosa_saat_rujukan_masuk = $row['diagnosa_saat_rujukan_masuk'];
$kondisi_saat_rujukan_masuk = $row['kondisi_saat_rujukan_masuk'];
$status_darurat = $row['status_darurat'];
$tgl_masuk = $row['tgl_masuk'];
$waktu_masuk = $row['waktu_masuk'];
$nama_department = $row['nama_department'];
$kode_department = $row['kode_department'];
$id_department = $row['id_department'];
$no_antrian = $row['no_antrian'];
$nama_dokter = $row['nama_dokter'];
$kode_dokter = $row['kode_dokter'];
$id_dokter = $row['id_dokter'];
$ket_tipe_pasien = $row['ket_tipe_pasien'];
$kode_tipe_pasien = $row['kode_tipe_pasien'];
$id_tipe_pasien = $row['id_tipe_pasien'];
$ket_diagnose = $row['ket_diagnose'];
$icds_diagnose = $row['icds_diagnose'];
$kode_diagnose = $row['kode_diagnose'];
$tipe_rujukan_keluar = $row['tipe_rujukan_keluar'];
$tujuan_rujukan_keluar = $row['tujuan_rujukan_keluar'];
$no_rujukan_keluar = $row['no_rujukan_keluar'];
$tgl_rujukan_keluar = $row['tgl_rujukan_keluar'];
$ket_diagnose_rujukan_keluar = $row['ket_diagnose_rujukan_keluar'];
$icds_rujukan_keluar = $row['icds_rujukan_keluar'];
$kode_dpjp = $row['kode_dpjp'];
$id_dpjp = $row['id_dpjp'];
$kondisi_rujukan_keluar = $row['kondisi_rujukan_keluar'];
$date_insert = $row['date_insert'];
$time_insert = $row['time_insert'];
$ts_insert = $row['ts_insert'];
$ts_update = $row['ts_update'];
$is_active = $row['is_active'];
$ip_address = $row['ip_address'];
$user_name = $row['user_name'];