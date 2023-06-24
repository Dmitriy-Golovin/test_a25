<?php

class IndexModel extends BaseModel {
    
    public function getAllProduct() {
        $productList = $this->db->get_all_assoc(
            $this->db->query_exc("SELECT * FROM a25_products")
        );

        $serviceList = unserialize(
            $this->db->mselect_rows('a25_settings', ['set_key' => 'services'], 0, 1, 'id')[0]['set_value']
        );

        return ['productList' => $productList, 'serviceList' => $serviceList];
    }

    public function getCost($data) {
        $errors = [];
        
        if (empty($data['product'])) {
            $errors['product'] = 'Обязательно для заполнения';
        }

        if (empty($data['customRange1'])) {
            $errors['customRange1'] = 'Обязательно для заполнения';
        }

        $dayNumber = !empty($data['customRange1']) ? (int)$data['customRange1'] : '';

        if (!is_int($dayNumber) && !empty($dayNumber)) {
            $errors['customRange1'] = 'Только целые числа';
        }

        if (($dayNumber < 1 || $dayNumber > 30) && !empty($dayNumber)) {
            $errors['customRange1'] = 'Количество дней от 1 до 30';
        }

        if (!empty($errors)) {
            return ['errors' => $errors];
        }

        $service1 = !empty($data['service1'])
            ? (int) $data['service1']
            : 0;
        $service2 = !empty($data['service2'])
            ? (int) $data['service2']
            : 0;
        $service3 = !empty($data['service3'])
            ? (int) $data['service3']
            : 0;
        $service4 = !empty($data['service4'])
            ? (int) $data['service4']
            : 0;

        $product = $this->db->mselect_rows('a25_products', ['ID' => $data['product']], 0, 1, 'id');
        
        if (!empty($product)) {
            $product = $product[0];
        } else {
            return ['errors' => ['product' => 'Товар не найден']];
        }

        $tariffDay = 0;

        if (!empty($product['TARIFF'])) {
            $tariff = unserialize($product['TARIFF']);

            foreach ($tariff as $index => $value) {
                if ($dayNumber >= $index) {
                    $tariffDay = $tariff[$index];
                }
            }
        } else {
            $tariffDay = $product['PRICE'];
        }

        $cost = $dayNumber * $tariffDay
            + $dayNumber * $service1
            + $dayNumber * $service2
            + $dayNumber * $service3
            + $dayNumber * $service4;

        
        return [
            'cost' => $cost,
            'dayNumber' => $dayNumber,
            'product' => $product['NAME']
        ];
    }
}