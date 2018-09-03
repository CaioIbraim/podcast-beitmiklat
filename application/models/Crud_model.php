<?php
class Crud_Model extends CI_Model
{
  public function select_where($id_table, $id_post, $table){
      $tabelas = explode(",", trim($table));
      $totTab = count($tabelas);
      if($totTab === 1){
         $query = $this->db->get_where($tabelas[0], array($id_table => $id_post));
         return $query->result_array();
      }
         $this->db->select('*');
         $this->db->from($tabelas[0]);
            for($i = 1; $i < $totTab; $i++){
               $this->db->join("$tabelas[$i]","$tabelas[$i].$id_table = $tabelas[0].$id_table");
            }
         $this->db->where("$tabelas[0].$id_table", "$id_post");
         $query = $this->db->get();
         return  $query->result_array();
  }
  //manobrando com update de tabelas
  public function update($id_tabela, $id_post,$data,$table){
     $this->db->where($id_tabela, $id_post);
     $this->db->update($table, $data);
     return $this->db->affected_rows();
  }
  //manobrando com insert de tabelas
  public function insert($data,$table){
    $this->db->insert($table, $data);
    return $this->db->affected_rows();
  }
  //manobrando com insert de tabelas
  public function delete($id_table,$id_post,$table){
    $this->db->delete($table, array($id_table => $id_post)); // Produces: // DELETE FROM mytable  // WHERE id = $id
    return $this->db->affected_rows();
  }
}
