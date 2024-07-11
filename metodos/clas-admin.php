<?php
class Admin {

    /**
     * 
     */
    public static function verUsuarios() {
        include_once("modelo.php");
        
        $consulta = Model::sqlCraerIdUsuario(2);
        $salida = '<div class="table-responsive">';
        $salida .= '<table class="user-table">';
        $salida .= '<thead>';
        $salida .= '<tr>';
        $salida .= '<th>Nombre</th>';
        $salida .= '<th>Email</th>';
        $salida .= '<th>Fecha de Registro</th>';
        $salida .= '<th>Rol</th>';
        $salida .= '<th>Extra</th>';
        $salida .= '</tr>';
        $salida .= '</thead>';
        $salida .= '<tbody>';
    
        while($fila = $consulta->fetch_array()) {
            $salida .= '<tr>'; 
            $salida .= '<td>' . htmlspecialchars($fila[1]) . ' ' . htmlspecialchars($fila[2]) . '</td>';
            $salida .= '<td>' . htmlspecialchars($fila[3]) . '</td>';
            $salida .= '<td>' . htmlspecialchars($fila[5]) . '</td>';
            $salida .= '<td>';
            if($fila[6] == 0) $salida .= 'SuperAdmin';
            if($fila[6] == 1) $salida .= 'Admin';
            if($fila[6] == 2) $salida .= 'Cliente';
            $salida .= '</td>';
            $salida .= '<td>' . htmlspecialchars($fila[7]) . '</td>';
            $salida .= '</tr>';
        }
    
        $salida .= '</tbody>';
        $salida .= '</table>';
        $salida .= '</div>'; 
    
        return $salida;
    }
    

}

