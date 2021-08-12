<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CrudModel extends CI_Model
{
    public function generateCode($code, $field, $table)
    {
        return $code.sprintf('%010s', (int) substr($this->db->select_max($field)->get($table)->row()->$field, 2, 10) + 1);
    }

    public function addData($table, $data = [])
    {
        $this->db->insert($table, $data);
    }

    public function updateData($tabel, $fieldid, $fieldvalue, $data = [])
    {
        $this->db->where($fieldid, $fieldvalue)->update($tabel, $data);
    }

    public function deleteData($tabel, $fieldid, $fieldvalue)
    {
        $this->db->where($fieldid, $fieldvalue)->delete($tabel);
    }

    public function getData($tabel)
    {
        $query = $this->db->get($tabel);

        return $query;
    }

    public function getDataWhere($tabel, $id, $nilai)
    {
        $this->db->where($id, $nilai);
        $query = $this->db->get($tabel);

        return $query;
    }

    public function getDataJoin($table, $onjoin, $where = [], $select = [])
    {
        $this->db->from($table);

        foreach ($onjoin as $key => $value) {
            $this->db->join($key, $value);
        }

        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (!empty($select)) {
            foreach ($select as $value) {
                $this->db->select($value);
            }
        }

        return $this->db->get();
    }

    public function getDataSum($value = [], $table, $field)
    {
        $this->db->from($table);
        if (!empty($value)) {
            for ($i = 0; $i < count($value); ++$i) {
                $this->db->where(array_keys($value)[$i], array_values($value)[$i]);
            }
        }
        $this->db->select_sum($field);

        return $this->db->get()->row();
    }

    public function getDataCount($value, $table)
    {
        $this->db->from($table);
        for ($i = 0; $i < count($value); ++$i) {
            $this->db->where(array_keys($value)[$i], array_values($value)[$i]);
        }

        return $this->db->count_all_results();
    }

    public function deleteImage($tabel, $fieldid, $fieldvalue, $image, $nama_file)
    {
        $img_delete = (array) $this->db->get_where($tabel, [$fieldid => $fieldvalue])->row();

        if ($img_delete[$image] != 'default.jpg') {
            $filename = explode('.', $img_delete[$image])[0];

            return array_map('unlink', glob(FCPATH.'upload/'.$nama_file.'/'.$filename.'.*'));
        }
    }
}
