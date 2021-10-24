<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
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
		$this->load->view('header', array('title' => 'List Pelanggan', 'active' => 'pelanggan'));
		$this->load->view('pelanggan');
		$this->load->view('footer');
	}

	public function insert()
	{
		$result = $this->db->get_where(TablePelanggan, array('nohp' => $_POST['nohp']))->result();
		if (count($result) == 0) {
			$this->session->set_flashdata('msg', 'Pelanggan berhasil ditambahkan.');
			$result = $this->dbhelper->save(TablePelanggan, $_POST);
			redirect('pelanggan');
		} else {
			$this->session->set_flashdata('msg_error', 'No Handphone sudah dipakai');
			redirect('pelanggan');
		}
	}
	public function edit()
	{
		$result = $this->db->get_where(TablePelanggan, array('nohp' => $_POST['nohp']))->result();
		$id = -1;
		foreach ($result as $key => $value) {
			$id = $value->id;
		}
		if (count($result) == 0 || (count($result) == 1 && $id == $_POST['id'])) {
			$this->session->set_flashdata('msg', 'Pelanggan berhasil diupdate.');
			$result = $this->dbhelper->update(TablePelanggan, 'id', $_POST['id'], $_POST);
			redirect('pelanggan');
		} else {
			$this->session->set_flashdata('msg_error', 'Pelanggan gagal diupdate.');
			redirect('pelanggan');
		}
	}

	public function delete()
	{
		$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : -1;
		$result = $this->db->get_where(TablePelanggan, array('id' => $id))->result();
		if (count($result) > 0) {
			$this->session->set_flashdata('msg', 'Pelanggan berhasil dihapus.');
			$result = $this->dbhelper->delete(TablePelanggan, 'id', $id);
			redirect('pelanggan');
		} else {
			$this->session->set_flashdata('msg_error', 'Pelanggan gagal dihapus');
			redirect('pelanggan');
		}
	}

	public function ajaxlist()
	{
		header('Content-Type: application/json');
		$this->datatable->init(TablePelanggan, array("id", "nama", "create_at", "update_at"), array("nama", "create_at", "update_at", "id"), array("id", "asc"));
		$list = $this->datatable->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama;
			$row[] = $field->nohp;
			$row[] = $field->alamat;
			$row[] = $field->keterangan;
			$row[] = $field->create_at;
			$row[] = $field->update_at;
			$row[] = '<button type="button" class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#showkendaraan" data-json-kendaraan='."'".json_encode($this->dbhelper->select(TableKendaraan,'id_pelanggan',$field->id))."'".' data-pelanggan=' . "'" . json_encode($field) . "'" . '>Kendaraan</button>'
			.'  <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#inlineForm-edit" data-json=' . "." . json_encode($field) . "'" . '>Edit</button>'
				. '  <a type="button" class="btn btn-danger rounded-pill" href="' . base_url("pelanggan/delete/$field->id") . '">Hapus</a>';
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
}
