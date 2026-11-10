<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
$store = __DIR__ . '/products_data.json';
if (is_file($store)) {
    $raw=@file_get_contents($store);
    $data=json_decode((string)$raw,true);
    // Apply tag overrides saved by the admin panel when the main JSON file is not writable.
    $overrideFile=dirname(__DIR__).'/tag_overrides.json';
    if (is_array($data) && is_file($overrideFile)) {
        $ov=json_decode((string)@file_get_contents($overrideFile),true);
        if (is_array($ov)) {
            foreach ($data['categories'] as &$cat) {
                foreach ($cat['items'] as &$item) {
                    $pid=(string)($item['id']??'');
                    if (array_key_exists($pid,$ov)) $item['tag']=$ov[$pid];
                }
            }
            unset($cat,$item);
        }
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    exit;
}
?>
{
    "ok": true,
    "categories": [
        {
            "slug": "diamonds",
            "name": "Diamonds",
            "icon": "💎",
            "image": "uploads/categories/categories_20260618131908_8da0ba.png",
            "items": [
                {
                    "id": "p1",
                    "icon": "💎",
                    "image": "uploads/products/products_20260618130216_7f8d25.png",
                    "amount": "100",
                    "name": "100 Diamonds",
                    "sub": "+10 bonus",
                    "price": 39,
                    "old": 90,
                    "tag": null,
                    "stock": 294,
                    "inStock": true
                },
                {
                    "id": "p2",
                    "icon": "💎",
                    "image": "uploads/products/products_20260618130432_e4e517.png",
                    "amount": "310",
                    "name": "310 Diamonds",
                    "sub": "+31 bonus",
                    "price": 99,
                    "old": 260,
                    "tag": "best",
                    "stock": 144,
                    "inStock": true
                },
                {
                    "id": "p3",
                    "icon": "💎",
                    "image": "uploads/products/products_20260618130756_687fd4.png",
                    "amount": "520",
                    "name": "520 Diamonds",
                    "sub": "+52 bonus",
                    "price": 149,
                    "old": 440,
                    "tag": "best",
                    "stock": 65,
                    "inStock": true
                },
                {
                    "id": "p4",
                    "icon": "💎",
                    "image": "uploads/products/products_20260618131428_da9e7d.png",
                    "amount": "1060",
                    "name": "1060 Diamonds",
                    "sub": "+106 bonus",
                    "price": 299,
                    "old": 860,
                    "tag": "hot",
                    "stock": 398,
                    "inStock": true
                },
                {
                    "id": "p5",
                    "icon": "💎",
                    "image": "uploads/products/products_20260618131446_ae70d5.png",
                    "amount": "2180",
                    "name": "2180 Diamonds",
                    "sub": "+218 bonus",
                    "price": 499,
                    "old": 1700,
                    "tag": "best",
                    "stock": 345,
                    "inStock": true
                },
                {
                    "id": "p6",
                    "icon": "💎",
                    "image": "uploads/products/products_20260618131503_e48bb6.png",
                    "amount": "5600",
                    "name": "5600 Diamonds",
                    "sub": "+560 bonus",
                    "price": 799,
                    "old": 4300,
                    "tag": "best",
                    "stock": 131,
                    "inStock": true
                }
            ]
        },
        {
            "slug": "passes",
            "name": "Passes",
            "icon": "🎟️",
            "image": "uploads/categories/categories_20260618132038_c0a216.png",
            "items": [
                {
                    "id": "p16",
                    "icon": "💎",
                    "image": "uploads/products/products_20260618133127_78497d.png",
                    "amount": "Weekly",
                    "name": "Weekly  Pass",
                    "sub": "15-day rewards track",
                    "price": 99,
                    "old": 159,
                    "tag": "hot",
                    "stock": 225,
                    "inStock": true
                },
                {
                    "id": "p17",
                    "icon": "💎",
                    "image": "uploads/products/products_20260618144016_48b5e4.png",
                    "amount": "Monthly",
                    "name": "Monthly Pass",
                    "sub": "30-day rewards track",
                    "price": 299,
                    "old": 799,
                    "tag": "hot",
                    "stock": 285,
                    "inStock": true
                },
                {
                    "id": "p18",
                    "icon": "💎",
                    "image": "uploads/products/products_20260618144137_8f687e.png",
                    "amount": "30 D Evo Pass",
                    "name": "30 D EVO ACCESS",
                    "sub": "30 DAYS ACCESS",
                    "price": 259,
                    "old": 599,
                    "tag": "best",
                    "stock": 124,
                    "inStock": true
                },
                {
                    "id": "p7",
                    "icon": "🎟️",
                    "image": "uploads/products/products_20260618132321_6d00cf.png",
                    "amount": "Booyah",
                    "name": "Booyah Pass",
                    "sub": "Current season — premium",
                    "price": 149,
                    "old": 499,
                    "tag": "hot",
                    "stock": 217,
                    "inStock": true
                },
                {
                    "id": "p8",
                    "icon": "👑",
                    "image": "uploads/products/products_20260618132415_969094.png",
                    "amount": "Booyah+",
                    "name": "Booyah Pass Plus",
                    "sub": "Premium + 30 level jump",
                    "price": 299,
                    "old": 999,
                    "tag": "best",
                    "stock": 133,
                    "inStock": true
                },
                {
                    "id": "p10",
                    "icon": "🎯",
                    "image": "uploads/products/products_20260618132946_87d030.png",
                    "amount": "Weekly",
                    "name": "Weekly Lite Pass",
                    "sub": "7-day rewards track",
                    "price": 39,
                    "old": 129,
                    "tag": null,
                    "stock": 156,
                    "inStock": true
                }
            ]
        }
    ]
}
