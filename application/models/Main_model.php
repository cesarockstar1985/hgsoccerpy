<?php

   class Main_model extends CI_Model {

      public $title;
      public $content;
      public $date;

      public function getJugadores($posicion = ""){

          if ($posicion != "") {
            $query = $this->db->get_where('jugadores', array('posicion' => $posicion));
          }else{
            $query = $this->db->get_where('jugadores');
          }

          return $query->result();
      }

      public function getEquipo($id){

        $queryEquipo = $this->db->get_where("trayectoria", array("id" => $id));        

        return $queryEquipo->result();

      }

      public function getJugador($idJugador){

        $trayectoriaTable = "trayectoria";

      	$queryJugador = $this->db->get_where("jugadores", array("id" => $idJugador));
        
        $queryCarrera = $this->db->from($trayectoriaTable)->where("id_jugador", $idJugador)->order_by('temporada', 'desc')->get();

        $datos = [
          "datosJugador" => $queryJugador->result(),
          "trayectoria"  => $queryCarrera->result()
        ];

        return $datos;
      }

      public function updateJugador($id, $data){

        $this->db->where('id', $id);

        $result = $this->db->update('jugadores', $data);

        return $result;

      }

      public function insertEquipo($data){

        $result = $this->db->insert('trayectoria', $data);

        return $result;

      }

      public function updateEquipo($id,$data){

        $this->db->where('id', $id);
        $result = $this->db->update('trayectoria', $data);

        return $result;

      }

      public function insertJugador($data){

        $result = $this->db->insert('jugadores', $data);

        return $this->db->insert_id();

      }

   }

?>