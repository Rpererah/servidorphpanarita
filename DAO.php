<?php
interface Dao {
    public function create($data);
    public function read();
    public function update($id, $data);
    public function delete($id);
}