<?php

namespace Classes;

namespace Classes;

class Paginacion {
    public $pagina_actual;
    public $registros_por_pagina;
    public $total_registros;

    public function __construct($pagina_actual = 1, $registros_por_pagina = 10, $total_registros = 0) {
        $this->pagina_actual = (int) $pagina_actual;
        $this->registros_por_pagina = (int) $registros_por_pagina;
        $this->total_registros = $total_registros;
    }

    public function offset() {
        return $this->registros_por_pagina * ($this->pagina_actual - 1);
    }

    public function total_paginas() {
        return ceil($this->total_registros / $this->registros_por_pagina);
    }

    public function pagina_anterior() {
        $anterior = $this->pagina_actual - 1;
        return ($anterior > 0) ? $anterior : false;
    }

    public function pagina_siguiente() {
        $siguiente = $this->pagina_actual + 1;
        return ($siguiente <= $this->total_paginas()) ? $siguiente : false;
    }

    public function enlace_anterior($params = []) {
        $html = '';
        if ($this->pagina_anterior()) {
            $queryString = http_build_query(array_merge($params, ['page' => $this->pagina_anterior()]));
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?{$queryString}\">&laquo; Anterior</a>";
        }
        return $html;
    }

    public function enlace_siguiente($params = []) {
        $html = '';
        if ($this->pagina_siguiente()) {
            $queryString = http_build_query(array_merge($params, ['page' => $this->pagina_siguiente()]));
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?{$queryString}\">Siguiente &raquo;</a>";
        }
        return $html;
    }

    public function numeros_paginas($params = []) {
        $html = '';
        for ($i = 1; $i <= $this->total_paginas(); $i++) {
            $queryString = http_build_query(array_merge($params, ['page' => $i]));
            if ($this->pagina_actual == $i) {
                $html .= "<span class=\"paginacion__enlace paginacion__enlace--actual\">{$i}</span>";
            } else {
                $html .= "<a class=\"paginacion__enlace paginacion__enlace--numero\" href=\"?{$queryString}\">{$i}</a>";
            }
        }
        return $html;
    }

    public function paginacion($params = []) {
        $html = '';
        if ($this->total_registros > 1) {
            $html .= '<div class="paginacion">';
            $html .= $this->enlace_anterior($params);
            $html .= $this->numeros_paginas($params);
            $html .= $this->enlace_siguiente($params);
            $html .= '</div>';
        }
        return $html;
    }
}



