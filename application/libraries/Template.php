<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Dikembangkan Oleh Andhika Putra Pratama.
 */
class Template
{
    private $_ci;
    //isikan nama aplikasi anda di sini
    public $_app_name = 'Tracer Study';
    //isikan detail tambahan aplikasi anda disini
    public $_app_slogan = 'Sekolah Anak Senang Bapak Bahagia';
    //pemisah judul
    public $_title_separator = ' | ';

    public function _render_page($view, $data = null, $returnhtml = false)
    {
        $this->_ci = &get_instance();
        //get data dari database jika ada
        $row = $this->get_data_situs();

        if (empty($this->_title)) {
            $this->_title = $this->_set_title();
        }
        if (empty($data['title'])) {
            $data['title'] = $this->_title;
        } else {
            if (isset($row['id_situs'])) {
                $data['title'] = humanize(implode($this->_title_separator, array($row['app_name'],  $data['title'])));
            } else {
                $data['title'] = humanize(implode($this->_title_separator, array($this->_app_name,  $data['title'])));
            }
        }
        if (isset($row['id_situs'])) {
            $data['_app_name'] = $row['app_name'];
            $data['_app_slogan'] = $row['app_slogan'];
            $data['_meta_deskripsi'] = $row['meta_deskripsi'];
            $data['_meta_keyword'] = $row['meta_keyword'];
            $data['_logo_website'] = $row['logo_website'];
        } else {
            $data['_app_name'] = $this->_app_name;
            $data['_app_slogan'] = $this->_app_slogan;
            $data['_meta_deskripsi'] = '';
            $data['_meta_keyword'] = '';
            $data['_logo_website'] = '';
        }

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->_ci->load->view($view, $this->viewdata, $returnhtml);

        if ($returnhtml) {
            return $view_html;
        }
    }

    public function get_data_situs()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->database();
        $this->_ci->db->where('id_situs', 1);
        return $this->_ci->db->get('situs')->row_array();
    }

    public function _title()
    {
        if (func_num_args() >= 1) {
            $title_segments = func_get_args();
            $this->_title = implode($this->_title_separator, $title_segments);
        }

        return $this;
    }

    private function _set_title()
    {
        $row = $this->get_data_situs();

        $this->_ci->load->helper('inflector');

        if (method_exists($this->_ci->router, 'fetch_module')) {
            $this->_module = $this->_ci->router->fetch_module();
        }

        $this->_controller = $this->_ci->router->fetch_class();
        $this->_method = $this->_ci->router->fetch_method();

        $title_parts = '';
        if ($this->_method != 'index') {
            $title_parts = $this->_method;
        } else {
            $title_parts = $this->_controller;
        }
        if (isset($row['id_situs'])) {
            $title = humanize(implode($this->_title_separator, array($row['app_name'], $title_parts)));
        } else {
            $title = humanize(implode($this->_title_separator, array($this->_app_name, $title_parts)));
        }

        return $title;
    }
}
