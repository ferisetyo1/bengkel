<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$data["uoms"] = $this->db->get(TableUoms)->result();
		$data["jenis"] = $this->db->get(TableJenis)->result();
		$data["rak"] = $this->db->get(TableRak)->result();

		$this->load->view('header', array('title' => 'List Barang', 'active' => 'list_barang'));
		$this->load->view('list_barang', $data);
		$this->load->view('footer');
	}

	public function insert()
	{
		$result = $this->db->get_where(TableBarang, array('kode_item' => $_POST['kode_item']))->result();
		if (count($result) == 0) {
			$this->session->set_flashdata('msg', 'Barang berhasil ditambahkan.');
			$result = $this->dbhelper->save(TableBarang, $_POST);
			redirect('barang');
		} else {
			$this->session->set_flashdata('msg_error', 'Kode barang sudah dipakai');
			redirect('barang');
		}
	}
	public function edit()
	{
		$result = $this->db->get_where(TableBarang, array('kode_item' => $_POST['kode_item']))->result();
		$id = -1;
		foreach ($result as $key => $value) {
			$id = $value->id;
		}
		if (count($result) == 0 || (count($result) == 1 && $id == $_POST['id'])) {
			$this->session->set_flashdata('msg', 'Barang berhasil diupdate.');
			$result = $this->dbhelper->update(TableBarang, 'id', $_POST['id'], $_POST);
			redirect('barang');
		} else {
			$this->session->set_flashdata('msg_error', 'Barang gagal diupdate.');
			redirect('barang');
		}
	}

	public function delete()
	{
		$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : -1;
		$result = $this->db->get_where(TableBarang, array('id' => $id))->result();
		if (count($result) > 0) {
			$this->session->set_flashdata('msg', 'Barang berhasil dihapus.');
			$result = $this->dbhelper->delete(TableBarang, 'id', $id);
			redirect('barang');
		} else {
			$this->session->set_flashdata('msg_error', 'Barang gagal dihapus');
			redirect('barang');
		}
	}

	public function ajaxlist()
	{
		header('Content-Type: application/json');
		$this->datatable->init(TableBarangJumlah, array("kode_item", "nama", "create_at", "update_at", "id"), array("kode_item", "nama", "create_at", "update_at", "id"), array("id", "asc"));
		$list = $this->datatable->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		//looping data mahasiswa
		foreach ($list as $field) {
			$no++;
			$row = array();
			//row pertama akan kita gunakan untuk btn edit dan delete
			$row[] = $no;
			$row[] = $field->kode_item;
			$row[] = $field->nama;
			$row[] = "Rp" . number_format($field->harga, 0, ',', '.');;
			$row[] = $field->jumlah;
			$rak = $this->db->get_where(TableRak, array('id' => $field->rak_id))->row();
			$jenis = $this->db->get_where(TableJenis, array('id' => $field->jenis_id))->row();
			$uoms = $this->db->get_where(TableUoms, array('id' => $field->uoms_id))->row();
			$row[] = ($rak) ? $rak->nama : "-";
			$row[] = ($jenis) ? $jenis->nama : "-";
			$row[] = ($uoms) ? $uoms->nama : "-";
			$row[] = $field->status == "" ? "Tidak dijual" : "Masih dijual";
			$row[] = $field->keterangan;
			$row[] = $field->create_at;
			$row[] = $field->update_at;
			$row[] = '<button type="button" class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#modal-stock" data-json=' . "'" . json_encode($this->dbhelper->select(TableStockName, 'barang_id', $field->id)) . "'" . '>Stock</button> '
				.			'<button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#inlineForm-edit" data-json=' . "." . json_encode($field) . "'" . '>Edit</button>'
				. '<a type="button" class="btn btn-danger rounded-pill" href="' . base_url("barang/delete/$field->id") . '">Hapus</a>';
			// $row[]="";
			$data[] = $row;
		}
		$output = array(
			"draw" => $this->input->post('draw'),
			"recordsTotal" => $this->datatable->count_all(),
			"recordsFiltered" => $this->datatable->count_filtered(),
			"data" => $data,
		);
		//output to json format
		$this->output->set_output(json_encode($output));
	}

	public function ajaxlist_keranjang()
	{
		header('Content-Type: application/json');
		$this->datatable->init(TableBarangJumlah, array("kode_item", "nama", "create_at", "update_at", "id"), array("kode_item", "nama", "create_at", "update_at", "id"), array("id", "asc"));
		$list = $this->datatable->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		//looping data mahasiswa
		foreach ($list as $field) {
			if ($field->jumlah > 0) {
				$no++;
				$row = array();
				//row pertama akan kita gunakan untuk btn edit dan delete
				$row[] = $no;
				$row[] = '<button type="button" class="btn btn-danger rounded-pill" onclick=' . "'addtocart(" . json_encode($field) . ")'" . '>+ Keranjang</button>';
				$row[] = $field->kode_item;
				$row[] = $field->nama;
				$row[] = "Rp" . number_format($field->harga, 0, ',', '.');;
				$row[] = $field->jumlah;
				$rak = $this->db->get_where(TableRak, array('id' => $field->rak_id))->row();
				$jenis = $this->db->get_where(TableJenis, array('id' => $field->jenis_id))->row();
				$uoms = $this->db->get_where(TableUoms, array('id' => $field->uoms_id))->row();
				$row[] = ($rak) ? $rak->nama : "-";
				$row[] = ($jenis) ? $jenis->nama : "-";
				$row[] = ($uoms) ? $uoms->nama : "-";
				$row[] = $field->status == "" ? "Tidak dijual" : "Masih dijual";
				$row[] = $field->keterangan;
				$data[] = $row;
			}
		}
		$output = array(
			"draw" => $this->input->post('draw'),
			"recordsTotal" => $this->datatable->count_all(),
			"recordsFiltered" => $this->datatable->count_filtered(),
			"data" => $data,
		);
		//output to json format
		$this->output->set_output(json_encode($output));
	}
}
