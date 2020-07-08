<?php

namespace Core;

class FileDB
{
    private $file_name;
    private $data;

    /**
     * FileDB constructor.
     * @param string $file_name
     */
    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     * Įrašo naują masyvą į data variabl'ą.
     * @param array $data_array
     */
    public function setData(array $data_array)
    {
        $this->data = $data_array;
    }

    /**
     * Įrašo visus duomenis į failą.
     */
    public function save()
    {
        $json_string = json_encode($this->data);
        $file = file_put_contents($this->file_name, $json_string);

        if ($file !== false) {
            return true;
        }

        return false;
    }

    /**
     * Gaunam masyvą duomenų iš failo.
     */
    public function load()
    {
        if (file_exists($this->file_name)) {
            $json_string = file_get_contents($this->file_name);
            if ($json_string !== false) {
                $this->data = json_decode($json_string, true);
                return true;
            }
        }

        $this->data = [];
        return false;
    }

    /**
     * Grąžina duomenų masyvą.
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function createTable(string $table_name): bool
    {
        if (!$this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

    public function tableExists(string $table_name): bool
    {
        return isset($this->data[$table_name]);
    }

    public function dropTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            unset($this->data[$table_name]);
            return true;
        }

        return false;
    }

    public function truncateTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

    public function insertRow(string $table_name, array $row, int $row_id = null)
    {
        if (!$this->tableExists($table_name) || $this->rowExists($table_name, $row_id)) {
            return false;
        }

        if ($row_id) {
            $this->data[$table_name][$row_id] = $row;
        } else {
            $this->data[$table_name][] = $row;
            $row_id = array_key_last($this->data[$table_name]);
        }

        return $row_id;
    }

    public function rowExists(string $table_name, $row_id): bool
    {
        return isset($this->data[$table_name][$row_id]);
    }

    public function insertRowIfNotExists(string $table_name, array $row, int $row_id)
    {
        if (!$this->rowExists($table_name, $row_id)) {
            $this->insertRow($table_name, $row, $row_id);
            return $row_id;
        }

        return false;
    }

    public function updateRow(string $table_name, array $row, int $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            $this->data[$table_name][$row_id] = $row;
            return true;
        }

        return false;
    }

    public function deleteRow(string $table_name, int $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            unset($this->data[$table_name][$row_id]);
            return true;
        }

        return false;
    }

    public function getRowById(string $table_name, int $row_id)
    {
        if ($this->rowExists($table_name, $row_id)) {
            return $this->data[$table_name][$row_id];
        }

        return false;
    }

    public function getRowsWhere(string $table_name, array $conditions): array
    {
        $rows = [];

        foreach ($this->data[$table_name] ?? [] as $row_id => $row) {
            $conditions_met = true;

            foreach ($conditions as $condition_key => $condition) {
                if ($row[$condition_key] !== $condition) {
                    $conditions_met = false;
                    break;
                }
            }

            if ($conditions_met) {
                $row['id'] = $row_id;
                $rows[$row_id] = $row;
            }
        }
        return $rows;
    }

    public function getRowWhere(string $table_name, array $conditions)
    {
        if (!$conditions) {
            return false;
        }

        foreach ($this->data[$table_name] ?? [] as $row) {
            $conditions_met = true;

            foreach ($conditions as $condition_id => $condition) {
                if ($row[$condition_id] !== $condition) {
                    $conditions_met = false;
                    break;
                }
            }

            if ($conditions_met) {
                return $row;
            }
        }

        return false;
    }

}
