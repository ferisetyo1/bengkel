<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uoms extends CI_Controller
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('header', array('title' => 'Satuan', 'active' => 'list_uoms'));
		$this->load->view('list_uoms');
		$this->load->view('footer');
	}

	public function insert()
	{
		$result = $this->db->get_where(TableUoms, array('nama' => $_POST['nama']))->result();
		if (count($result) == 0) {
			$this->session->set_flashdata('msg', 'Satuan berhasil ditambahkan.');
			$result = $this->dbhelper->save(TableUoms, array('nama' => $_POST['nama']));
			redirect('uoms');
		} else {
			$this->session->set_flashdata('msg_error', 'Satuan sudah ada.');
			redirect('uoms');
		}
	}

	public function edit()
	{
		$result = $this->db->get_where(TableUoms, array('nama' => $_POST['nama']))->result();
		if (count($result) == 0) {
			$this->session->set_flashdata('msg', 'Satuan berhasil diupdate.');
			$result = $this->dbhelper->update(TableUoms,'id',$_POST['id'], array('nama' => $_POST['nama']));
			redirect('uoms');
		} else {
			$this->session->set_flashdata('msg_error', 'Satuan sudah ada.');
			redirect('uoms');
		}
	}

	public function delete()
	{
		$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : -1;
		$result = $this->db->get_where(TableUoms, array('id' => $id))->result();
		if (count($result) > 0) {
			$this->session->set_flashdata('msg', 'Satuan berhasil dihapus.');
			$result = $this->dbhelper->delete(TableUoms, 'id', $id);
			redirect('uoms');
		} else {
			$this->session->set_flashdata('msg_error', 'Satuan gagal dihapus');
			redirect('uoms');
		}
	}
	public function ajaxlist()
	{
		header('Content-Type: application/json');
		$this->datatable->init(TableUoms, array("id", "nama", "create_at", "update_at"), array("nama", "create_at", "update_at", "id"), array("id", "asc"));
		$list = $this->datatable->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama;
			$row[] = $field->create_at;
			$row[] = $field->update_at;
			$row[] = '<button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#inlineForm-edit" data-json=' . "." . json_encode($field) . "'" . '>Edit</button>'
				. '  <a type="button" class="btn btn-danger rounded-pill" href="' . base_url("uoms/delete/$field->id") . '">Hapus</a>';
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
