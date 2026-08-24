# Comprehensive API Documentation

This document details all API routes available in the system, including the request method, endpoint, description, a detailed response example, and an explanation of the response fields.

## Ads

### 1. `GET` api/ads

**Description:** Get all ads (paginated).

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "title_en": "Summer Sale",
            "title_ar": "تخفيضات الصيف",
            "description_en": "Up to 50% off on all items.",
            "description_ar": "خصم يصل إلى 50% على جميع المنتجات.",
            "image": "https://example.com/storage/ads/1.jpg",
            "url": "https://example.com/sale",
            "is_active": true,
            "sort_order": 1,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Ad** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the ad.
- `title_en`: English title of the ad.
- `title_ar`: Arabic title of the ad.
- `description_en`: English description of the ad.
- `description_ar`: Arabic description of the ad.
- `image`: Full URL of the ad image.
- `url`: External link when the ad is clicked.
- `is_active`: Boolean indicating whether the ad is currently visible.
- `sort_order`: Order in which the ad should be displayed relative to others.
- `created_at`: Timestamp of when the ad was created.
- `updated_at`: Timestamp of the last update to the ad.

---

### 2. `POST` api/ads

**Description:** Create a new ad.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "title_en": "Summer Sale",
        "title_ar": "تخفيضات الصيف",
        "description_en": "Up to 50% off on all items.",
        "description_ar": "خصم يصل إلى 50% على جميع المنتجات.",
        "image": "https://example.com/storage/ads/1.jpg",
        "url": "https://example.com/sale",
        "is_active": true,
        "sort_order": 1,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Ad** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the ad.
- `title_en`: English title of the ad.
- `title_ar`: Arabic title of the ad.
- `description_en`: English description of the ad.
- `description_ar`: Arabic description of the ad.
- `image`: Full URL of the ad image.
- `url`: External link when the ad is clicked.
- `is_active`: Boolean indicating whether the ad is currently visible.
- `sort_order`: Order in which the ad should be displayed relative to others.
- `created_at`: Timestamp of when the ad was created.
- `updated_at`: Timestamp of the last update to the ad.

---

### 3. `GET` api/ads/{ad}

**Description:** Get a specific ad.

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "title_en": "Summer Sale",
        "title_ar": "تخفيضات الصيف",
        "description_en": "Up to 50% off on all items.",
        "description_ar": "خصم يصل إلى 50% على جميع المنتجات.",
        "image": "https://example.com/storage/ads/1.jpg",
        "url": "https://example.com/sale",
        "is_active": true,
        "sort_order": 1,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `data`: The main **Ad** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the ad.
- `title_en`: English title of the ad.
- `title_ar`: Arabic title of the ad.
- `description_en`: English description of the ad.
- `description_ar`: Arabic description of the ad.
- `image`: Full URL of the ad image.
- `url`: External link when the ad is clicked.
- `is_active`: Boolean indicating whether the ad is currently visible.
- `sort_order`: Order in which the ad should be displayed relative to others.
- `created_at`: Timestamp of when the ad was created.
- `updated_at`: Timestamp of the last update to the ad.

---

### 4. `PUT|PATCH` api/ads/{ad}

**Description:** Update an ad.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "title_en": "Summer Sale",
        "title_ar": "تخفيضات الصيف",
        "description_en": "Up to 50% off on all items.",
        "description_ar": "خصم يصل إلى 50% على جميع المنتجات.",
        "image": "https://example.com/storage/ads/1.jpg",
        "url": "https://example.com/sale",
        "is_active": true,
        "sort_order": 1,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Ad** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the ad.
- `title_en`: English title of the ad.
- `title_ar`: Arabic title of the ad.
- `description_en`: English description of the ad.
- `description_ar`: Arabic description of the ad.
- `image`: Full URL of the ad image.
- `url`: External link when the ad is clicked.
- `is_active`: Boolean indicating whether the ad is currently visible.
- `sort_order`: Order in which the ad should be displayed relative to others.
- `created_at`: Timestamp of when the ad was created.
- `updated_at`: Timestamp of the last update to the ad.

---

### 5. `DELETE` api/ads/{ad}

**Description:** Delete an ad.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

## Cart

### 1. `GET` api/cart

**Description:** Get current user cart items.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "product": {
                "id": 1,
                "name_en": "Smartphone",
                "name_ar": "هاتف ذكي",
                "unique_number": "PRD-9876",
                "barcode": "123456789012",
                "description_en": "Latest smartphone model",
                "description_ar": "أحدث موديل هاتف ذكي",
                "status": true,
                "category": {
                    "id": 1,
                    "name_en": "Electronics",
                    "name_ar": "إلكترونيات",
                    "slug": "electronics",
                    "description_en": "All electronic items",
                    "description_ar": "جميع الأجهزة الإلكترونية",
                    "image": "https://example.com/storage/categories/1.jpg",
                    "status": "active",
                    "created_at": "2023-08-01 10:00:00"
                },
                "images": [
                    {
                        "id": 1,
                        "image": "https://example.com/storage/products/1.jpg"
                    }
                ],
                "units": [
                    {
                        "id": 1,
                        "name_en": "Piece",
                        "name_ar": "قطعة",
                        "quantity": 50,
                        "price": 1000,
                        "sold_quantity_last_2_days": 10,
                        "buyers_count_last_2_days": 5,
                        "original_price": 1200,
                        "discount": 200,
                        "final_price": 1000,
                        "offer": {
                            "id": 1,
                            "title_en": "Summer Sale",
                            "title_ar": "تخفيضات الصيف",
                            "description_en": "Up to 200 off",
                            "description_ar": "خصم يصل إلى 200",
                            "type": "fixed",
                            "value": 200,
                            "start_date": "2023-08-01",
                            "end_date": "2023-08-31"
                        }
                    },
                    {
                        "id": 2,
                        "name_en": "Box",
                        "name_ar": "صندوق",
                        "quantity": 10,
                        "price": 5000,
                        "sold_quantity_last_2_days": 2,
                        "buyers_count_last_2_days": 2,
                        "offer": {
                            "id": 2,
                            "title_en": "Buy 1 Get 1",
                            "title_ar": "اشتري 1 واحصل على 1",
                            "description_en": "Buy 1 Box get 1 Piece free",
                            "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                            "type": "gift",
                            "buy_quantity": 1,
                            "gift_quantity": 1,
                            "gift_product": {
                                "product_id": 1,
                                "unit_id": 1,
                                "product_name_en": "Smartphone",
                                "product_name_ar": "هاتف ذكي",
                                "unit_name_en": "Piece",
                                "unit_name_ar": "قطعة"
                            },
                            "start_date": "2023-08-01",
                            "end_date": "2023-08-31"
                        }
                    }
                ],
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            },
            "unit": {
                "id": 1,
                "name_en": "Piece",
                "name_ar": "قطعة",
                "symbol": "pcs",
                "status": "active"
            },
            "quantity": 2,
            "original_price": 1000,
            "discount": 100,
            "new_price": 900,
            "total": 1800,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Cart** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier of the cart item.
- `product`: Full details of the product added to the cart.
- `unit`: Full details of the unit of measure for the selected product (e.g., piece, kg).
- `quantity`: Number of units selected by the user.
- `original_price`: Price before any discounts.
- `discount`: Discount applied to the item.
- `new_price`: Price after discount.
- `total`: Total cost for this item (new_price * quantity).
- `created_at`: When the item was added to the cart.
- `updated_at`: When the item was last modified in the cart.

---

### 2. `POST` api/cart

**Description:** Add item to cart.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "product": {
            "id": 1,
            "name_en": "Smartphone",
            "name_ar": "هاتف ذكي",
            "unique_number": "PRD-9876",
            "barcode": "123456789012",
            "description_en": "Latest smartphone model",
            "description_ar": "أحدث موديل هاتف ذكي",
            "status": true,
            "category": {
                "id": 1,
                "name_en": "Electronics",
                "name_ar": "إلكترونيات",
                "slug": "electronics",
                "description_en": "All electronic items",
                "description_ar": "جميع الأجهزة الإلكترونية",
                "image": "https://example.com/storage/categories/1.jpg",
                "status": "active",
                "created_at": "2023-08-01 10:00:00"
            },
            "images": [
                {
                    "id": 1,
                    "image": "https://example.com/storage/products/1.jpg"
                }
            ],
            "units": [
                {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "quantity": 50,
                    "price": 1000,
                    "sold_quantity_last_2_days": 10,
                    "buyers_count_last_2_days": 5,
                    "original_price": 1200,
                    "discount": 200,
                    "final_price": 1000,
                    "offer": {
                        "id": 1,
                        "title_en": "Summer Sale",
                        "title_ar": "تخفيضات الصيف",
                        "description_en": "Up to 200 off",
                        "description_ar": "خصم يصل إلى 200",
                        "type": "fixed",
                        "value": 200,
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                },
                {
                    "id": 2,
                    "name_en": "Box",
                    "name_ar": "صندوق",
                    "quantity": 10,
                    "price": 5000,
                    "sold_quantity_last_2_days": 2,
                    "buyers_count_last_2_days": 2,
                    "offer": {
                        "id": 2,
                        "title_en": "Buy 1 Get 1",
                        "title_ar": "اشتري 1 واحصل على 1",
                        "description_en": "Buy 1 Box get 1 Piece free",
                        "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                        "type": "gift",
                        "buy_quantity": 1,
                        "gift_quantity": 1,
                        "gift_product": {
                            "product_id": 1,
                            "unit_id": 1,
                            "product_name_en": "Smartphone",
                            "product_name_ar": "هاتف ذكي",
                            "unit_name_en": "Piece",
                            "unit_name_ar": "قطعة"
                        },
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                }
            ],
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "unit": {
            "id": 1,
            "name_en": "Piece",
            "name_ar": "قطعة",
            "symbol": "pcs",
            "status": "active"
        },
        "quantity": 2,
        "original_price": 1000,
        "discount": 100,
        "new_price": 900,
        "total": 1800,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Cart** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier of the cart item.
- `product`: Full details of the product added to the cart.
- `unit`: Full details of the unit of measure for the selected product (e.g., piece, kg).
- `quantity`: Number of units selected by the user.
- `original_price`: Price before any discounts.
- `discount`: Discount applied to the item.
- `new_price`: Price after discount.
- `total`: Total cost for this item (new_price * quantity).
- `created_at`: When the item was added to the cart.
- `updated_at`: When the item was last modified in the cart.

---

### 3. `DELETE` api/cart

**Description:** Clear cart.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

### 4. `PUT` api/cart/{cartItem}

**Description:** Update cart item quantity.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "product": {
            "id": 1,
            "name_en": "Smartphone",
            "name_ar": "هاتف ذكي",
            "unique_number": "PRD-9876",
            "barcode": "123456789012",
            "description_en": "Latest smartphone model",
            "description_ar": "أحدث موديل هاتف ذكي",
            "status": true,
            "category": {
                "id": 1,
                "name_en": "Electronics",
                "name_ar": "إلكترونيات",
                "slug": "electronics",
                "description_en": "All electronic items",
                "description_ar": "جميع الأجهزة الإلكترونية",
                "image": "https://example.com/storage/categories/1.jpg",
                "status": "active",
                "created_at": "2023-08-01 10:00:00"
            },
            "images": [
                {
                    "id": 1,
                    "image": "https://example.com/storage/products/1.jpg"
                }
            ],
            "units": [
                {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "quantity": 50,
                    "price": 1000,
                    "sold_quantity_last_2_days": 10,
                    "buyers_count_last_2_days": 5,
                    "original_price": 1200,
                    "discount": 200,
                    "final_price": 1000,
                    "offer": {
                        "id": 1,
                        "title_en": "Summer Sale",
                        "title_ar": "تخفيضات الصيف",
                        "description_en": "Up to 200 off",
                        "description_ar": "خصم يصل إلى 200",
                        "type": "fixed",
                        "value": 200,
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                },
                {
                    "id": 2,
                    "name_en": "Box",
                    "name_ar": "صندوق",
                    "quantity": 10,
                    "price": 5000,
                    "sold_quantity_last_2_days": 2,
                    "buyers_count_last_2_days": 2,
                    "offer": {
                        "id": 2,
                        "title_en": "Buy 1 Get 1",
                        "title_ar": "اشتري 1 واحصل على 1",
                        "description_en": "Buy 1 Box get 1 Piece free",
                        "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                        "type": "gift",
                        "buy_quantity": 1,
                        "gift_quantity": 1,
                        "gift_product": {
                            "product_id": 1,
                            "unit_id": 1,
                            "product_name_en": "Smartphone",
                            "product_name_ar": "هاتف ذكي",
                            "unit_name_en": "Piece",
                            "unit_name_ar": "قطعة"
                        },
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                }
            ],
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "unit": {
            "id": 1,
            "name_en": "Piece",
            "name_ar": "قطعة",
            "symbol": "pcs",
            "status": "active"
        },
        "quantity": 2,
        "original_price": 1000,
        "discount": 100,
        "new_price": 900,
        "total": 1800,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Cart** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier of the cart item.
- `product`: Full details of the product added to the cart.
- `unit`: Full details of the unit of measure for the selected product (e.g., piece, kg).
- `quantity`: Number of units selected by the user.
- `original_price`: Price before any discounts.
- `discount`: Discount applied to the item.
- `new_price`: Price after discount.
- `total`: Total cost for this item (new_price * quantity).
- `created_at`: When the item was added to the cart.
- `updated_at`: When the item was last modified in the cart.

---

### 5. `DELETE` api/cart/{cartItem}

**Description:** Remove item from cart.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

## Categories

### 1. `GET` api/categories

**Description:** Get all categories.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "name_en": "Electronics",
            "name_ar": "إلكترونيات",
            "slug": "electronics",
            "description_en": "All electronic items",
            "description_ar": "جميع الأجهزة الإلكترونية",
            "image": "https://example.com/storage/categories/1.jpg",
            "status": "active",
            "created_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Category** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the category.
- `name_en`: Category name in English.
- `name_ar`: Category name in Arabic.
- `slug`: URL-friendly identifier for the category.
- `description_en`: Category description in English.
- `description_ar`: Category description in Arabic.
- `image`: Full URL of the category image.
- `status`: Status of the category (e.g., active, inactive).
- `created_at`: Timestamp of when the category was created.

---

### 2. `POST` api/categories

**Description:** Create a category.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "name_en": "Electronics",
        "name_ar": "إلكترونيات",
        "slug": "electronics",
        "description_en": "All electronic items",
        "description_ar": "جميع الأجهزة الإلكترونية",
        "image": "https://example.com/storage/categories/1.jpg",
        "status": "active",
        "created_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Category** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the category.
- `name_en`: Category name in English.
- `name_ar`: Category name in Arabic.
- `slug`: URL-friendly identifier for the category.
- `description_en`: Category description in English.
- `description_ar`: Category description in Arabic.
- `image`: Full URL of the category image.
- `status`: Status of the category (e.g., active, inactive).
- `created_at`: Timestamp of when the category was created.

---

### 3. `GET` api/categories/{category}

**Description:** Get a specific category.

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "name_en": "Electronics",
        "name_ar": "إلكترونيات",
        "slug": "electronics",
        "description_en": "All electronic items",
        "description_ar": "جميع الأجهزة الإلكترونية",
        "image": "https://example.com/storage/categories/1.jpg",
        "status": "active",
        "created_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `data`: The main **Category** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the category.
- `name_en`: Category name in English.
- `name_ar`: Category name in Arabic.
- `slug`: URL-friendly identifier for the category.
- `description_en`: Category description in English.
- `description_ar`: Category description in Arabic.
- `image`: Full URL of the category image.
- `status`: Status of the category (e.g., active, inactive).
- `created_at`: Timestamp of when the category was created.

---

### 4. `PUT|PATCH` api/categories/{category}

**Description:** Update a category.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "name_en": "Electronics",
        "name_ar": "إلكترونيات",
        "slug": "electronics",
        "description_en": "All electronic items",
        "description_ar": "جميع الأجهزة الإلكترونية",
        "image": "https://example.com/storage/categories/1.jpg",
        "status": "active",
        "created_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Category** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the category.
- `name_en`: Category name in English.
- `name_ar`: Category name in Arabic.
- `slug`: URL-friendly identifier for the category.
- `description_en`: Category description in English.
- `description_ar`: Category description in Arabic.
- `image`: Full URL of the category image.
- `status`: Status of the category (e.g., active, inactive).
- `created_at`: Timestamp of when the category was created.

---

### 5. `DELETE` api/categories/{category}

**Description:** Delete a category.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

### 6. `GET` api/categories/{category}/products

**Description:** Get products by category.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "name_en": "Smartphone",
            "name_ar": "هاتف ذكي",
            "unique_number": "PRD-9876",
            "barcode": "123456789012",
            "description_en": "Latest smartphone model",
            "description_ar": "أحدث موديل هاتف ذكي",
            "status": true,
            "category": {
                "id": 1,
                "name_en": "Electronics",
                "name_ar": "إلكترونيات",
                "slug": "electronics",
                "description_en": "All electronic items",
                "description_ar": "جميع الأجهزة الإلكترونية",
                "image": "https://example.com/storage/categories/1.jpg",
                "status": "active",
                "created_at": "2023-08-01 10:00:00"
            },
            "images": [
                {
                    "id": 1,
                    "image": "https://example.com/storage/products/1.jpg"
                }
            ],
            "units": [
                {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "quantity": 50,
                    "price": 1000,
                    "sold_quantity_last_2_days": 10,
                    "buyers_count_last_2_days": 5,
                    "original_price": 1200,
                    "discount": 200,
                    "final_price": 1000,
                    "offer": {
                        "id": 1,
                        "title_en": "Summer Sale",
                        "title_ar": "تخفيضات الصيف",
                        "description_en": "Up to 200 off",
                        "description_ar": "خصم يصل إلى 200",
                        "type": "fixed",
                        "value": 200,
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                },
                {
                    "id": 2,
                    "name_en": "Box",
                    "name_ar": "صندوق",
                    "quantity": 10,
                    "price": 5000,
                    "sold_quantity_last_2_days": 2,
                    "buyers_count_last_2_days": 2,
                    "offer": {
                        "id": 2,
                        "title_en": "Buy 1 Get 1",
                        "title_ar": "اشتري 1 واحصل على 1",
                        "description_en": "Buy 1 Box get 1 Piece free",
                        "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                        "type": "gift",
                        "buy_quantity": 1,
                        "gift_quantity": 1,
                        "gift_product": {
                            "product_id": 1,
                            "unit_id": 1,
                            "product_name_en": "Smartphone",
                            "product_name_ar": "هاتف ذكي",
                            "unit_name_en": "Piece",
                            "unit_name_ar": "قطعة"
                        },
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                }
            ],
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Product** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the product.
- `name_en`: Product name in English.
- `name_ar`: Product name in Arabic.
- `unique_number`: Internal SKU or unique product identifier.
- `barcode`: Barcode number of the product.
- `description_en`: Detailed product description in English.
- `description_ar`: Detailed product description in Arabic.
- `status`: Availability status (boolean).
- `category`: Full Category resource this product belongs to.
- `images`: Array of product images.
- `units`: Available units of measurement for the product along with detailed pricing, sales stats, and active offers.
- `units[].original_price`: (Optional) The original price of the unit before discount.
- `units[].discount`: (Optional) The discount amount applied.
- `units[].final_price`: (Optional) The final price after discount.
- `units[].offer`: (Optional) The active offer (discount or gift) applied to this product unit.

---

## Coupons

### 1. `GET` api/coupons

**Description:** Get all coupons.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "code": "DISCOUNT20",
            "type": "percentage",
            "value": 20,
            "minimum_order_amount": 100,
            "usage_limit": 100,
            "used_count": 10,
            "start_date": "2023-08-01",
            "end_date": "2023-08-31",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Coupon** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the coupon.
- `code`: The coupon code to be entered by the user.
- `type`: Type of discount (e.g., percentage, fixed).
- `value`: Discount amount or percentage.
- `minimum_order_amount`: Minimum order total required to apply the coupon.
- `usage_limit`: Maximum number of times this coupon can be used overall.
- `used_count`: Number of times this coupon has already been used.
- `start_date`: Date when the coupon becomes active.
- `end_date`: Date when the coupon expires.
- `is_active`: Boolean indicating whether the coupon can be used.
- `created_at`: Creation timestamp.
- `updated_at`: Last update timestamp.

---

### 2. `POST` api/coupons

**Description:** Create a new coupon.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "code": "DISCOUNT20",
        "type": "percentage",
        "value": 20,
        "minimum_order_amount": 100,
        "usage_limit": 100,
        "used_count": 10,
        "start_date": "2023-08-01",
        "end_date": "2023-08-31",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Coupon** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the coupon.
- `code`: The coupon code to be entered by the user.
- `type`: Type of discount (e.g., percentage, fixed).
- `value`: Discount amount or percentage.
- `minimum_order_amount`: Minimum order total required to apply the coupon.
- `usage_limit`: Maximum number of times this coupon can be used overall.
- `used_count`: Number of times this coupon has already been used.
- `start_date`: Date when the coupon becomes active.
- `end_date`: Date when the coupon expires.
- `is_active`: Boolean indicating whether the coupon can be used.
- `created_at`: Creation timestamp.
- `updated_at`: Last update timestamp.

---

### 3. `POST` api/coupons/check

**Description:** Check if a coupon is valid.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "code": "DISCOUNT20",
        "type": "percentage",
        "value": 20,
        "minimum_order_amount": 100,
        "usage_limit": 100,
        "used_count": 10,
        "start_date": "2023-08-01",
        "end_date": "2023-08-31",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Coupon** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the coupon.
- `code`: The coupon code to be entered by the user.
- `type`: Type of discount (e.g., percentage, fixed).
- `value`: Discount amount or percentage.
- `minimum_order_amount`: Minimum order total required to apply the coupon.
- `usage_limit`: Maximum number of times this coupon can be used overall.
- `used_count`: Number of times this coupon has already been used.
- `start_date`: Date when the coupon becomes active.
- `end_date`: Date when the coupon expires.
- `is_active`: Boolean indicating whether the coupon can be used.
- `created_at`: Creation timestamp.
- `updated_at`: Last update timestamp.

---

### 4. `GET` api/coupons/{coupon}

**Description:** Get a specific coupon.

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "code": "DISCOUNT20",
        "type": "percentage",
        "value": 20,
        "minimum_order_amount": 100,
        "usage_limit": 100,
        "used_count": 10,
        "start_date": "2023-08-01",
        "end_date": "2023-08-31",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `data`: The main **Coupon** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the coupon.
- `code`: The coupon code to be entered by the user.
- `type`: Type of discount (e.g., percentage, fixed).
- `value`: Discount amount or percentage.
- `minimum_order_amount`: Minimum order total required to apply the coupon.
- `usage_limit`: Maximum number of times this coupon can be used overall.
- `used_count`: Number of times this coupon has already been used.
- `start_date`: Date when the coupon becomes active.
- `end_date`: Date when the coupon expires.
- `is_active`: Boolean indicating whether the coupon can be used.
- `created_at`: Creation timestamp.
- `updated_at`: Last update timestamp.

---

### 5. `PUT|PATCH` api/coupons/{coupon}

**Description:** Update a coupon.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "code": "DISCOUNT20",
        "type": "percentage",
        "value": 20,
        "minimum_order_amount": 100,
        "usage_limit": 100,
        "used_count": 10,
        "start_date": "2023-08-01",
        "end_date": "2023-08-31",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Coupon** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the coupon.
- `code`: The coupon code to be entered by the user.
- `type`: Type of discount (e.g., percentage, fixed).
- `value`: Discount amount or percentage.
- `minimum_order_amount`: Minimum order total required to apply the coupon.
- `usage_limit`: Maximum number of times this coupon can be used overall.
- `used_count`: Number of times this coupon has already been used.
- `start_date`: Date when the coupon becomes active.
- `end_date`: Date when the coupon expires.
- `is_active`: Boolean indicating whether the coupon can be used.
- `created_at`: Creation timestamp.
- `updated_at`: Last update timestamp.

---

### 6. `DELETE` api/coupons/{coupon}

**Description:** Delete a coupon.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

## Delivery

### 1. `GET` api/delivery/available-orders

**Description:** Get available orders for delivery.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "order_number": "ORD-123456",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            },
            "location": {
                "id": 1,
                "title": "Home",
                "address": "123 Main St, City, Country",
                "latitude": 24.7136,
                "longitude": 46.6753,
                "is_default": true,
                "created_at": "2023-08-01 10:00:00",
                "user": {
                    "id": 1,
                    "name": "John Doe",
                    "email": "john@example.com",
                    "phone": "+123456789",
                    "email_verified_at": "2023-08-01 10:00:00",
                    "role": "customer",
                    "is_active": true,
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                }
            },
            "delivery_driver": {
                "id": 2,
                "name": "Driver Ali",
                "email": "ali@example.com",
                "phone": "+987654321",
                "role": "delivery"
            },
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "role": "customer",
            "items": [
                {
                    "id": 1,
                    "product": {
                        "id": 1,
                        "name_en": "Smartphone",
                        "name_ar": "هاتف ذكي",
                        "unique_number": "PRD-9876",
                        "barcode": "123456789012",
                        "description_en": "Latest smartphone model",
                        "description_ar": "أحدث موديل هاتف ذكي",
                        "status": true,
                        "category": {
                            "id": 1,
                            "name_en": "Electronics",
                            "name_ar": "إلكترونيات",
                            "slug": "electronics",
                            "description_en": "All electronic items",
                            "description_ar": "جميع الأجهزة الإلكترونية",
                            "image": "https://example.com/storage/categories/1.jpg",
                            "status": "active",
                            "created_at": "2023-08-01 10:00:00"
                        },
                        "images": [
                            {
                                "id": 1,
                                "image": "https://example.com/storage/products/1.jpg"
                            }
                        ],
                        "units": [
                            {
                                "id": 1,
                                "name_en": "Piece",
                                "name_ar": "قطعة",
                                "quantity": 50,
                                "price": 1000,
                                "sold_quantity_last_2_days": 10,
                                "buyers_count_last_2_days": 5,
                                "original_price": 1200,
                                "discount": 200,
                                "final_price": 1000,
                                "offer": {
                                    "id": 1,
                                    "title_en": "Summer Sale",
                                    "title_ar": "تخفيضات الصيف",
                                    "description_en": "Up to 200 off",
                                    "description_ar": "خصم يصل إلى 200",
                                    "type": "fixed",
                                    "value": 200,
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            },
                            {
                                "id": 2,
                                "name_en": "Box",
                                "name_ar": "صندوق",
                                "quantity": 10,
                                "price": 5000,
                                "sold_quantity_last_2_days": 2,
                                "buyers_count_last_2_days": 2,
                                "offer": {
                                    "id": 2,
                                    "title_en": "Buy 1 Get 1",
                                    "title_ar": "اشتري 1 واحصل على 1",
                                    "description_en": "Buy 1 Box get 1 Piece free",
                                    "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                    "type": "gift",
                                    "buy_quantity": 1,
                                    "gift_quantity": 1,
                                    "gift_product": {
                                        "product_id": 1,
                                        "unit_id": 1,
                                        "product_name_en": "Smartphone",
                                        "product_name_ar": "هاتف ذكي",
                                        "unit_name_en": "Piece",
                                        "unit_name_ar": "قطعة"
                                    },
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            }
                        ],
                        "created_at": "2023-08-01 10:00:00",
                        "updated_at": "2023-08-01 10:00:00"
                    },
                    "unit": {
                        "id": 1,
                        "name_en": "Piece",
                        "name_ar": "قطعة",
                        "symbol": "pcs",
                        "status": "active"
                    },
                    "quantity": 2,
                    "price": 1000,
                    "total": 2000,
                    "is_gift": false
                }
            ],
            "subtotal": 2000,
            "delivery_fee": 20,
            "discount": 100,
            "total": 1920,
            "payment_method": "cash_on_delivery",
            "payment_status": "pending",
            "coupon": {
                "id": 1,
                "code": "DISCOUNT20",
                "type": "percentage",
                "value": 20
            },
            "coupon_discount": 100,
            "status": "pending",
            "notes": "Deliver after 5 PM",
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Order** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 2. `GET` api/delivery/orders

**Description:** Get orders assigned to delivery driver.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "order_number": "ORD-123456",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            },
            "location": {
                "id": 1,
                "title": "Home",
                "address": "123 Main St, City, Country",
                "latitude": 24.7136,
                "longitude": 46.6753,
                "is_default": true,
                "created_at": "2023-08-01 10:00:00",
                "user": {
                    "id": 1,
                    "name": "John Doe",
                    "email": "john@example.com",
                    "phone": "+123456789",
                    "email_verified_at": "2023-08-01 10:00:00",
                    "role": "customer",
                    "is_active": true,
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                }
            },
            "delivery_driver": {
                "id": 2,
                "name": "Driver Ali",
                "email": "ali@example.com",
                "phone": "+987654321",
                "role": "delivery"
            },
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "role": "customer",
            "items": [
                {
                    "id": 1,
                    "product": {
                        "id": 1,
                        "name_en": "Smartphone",
                        "name_ar": "هاتف ذكي",
                        "unique_number": "PRD-9876",
                        "barcode": "123456789012",
                        "description_en": "Latest smartphone model",
                        "description_ar": "أحدث موديل هاتف ذكي",
                        "status": true,
                        "category": {
                            "id": 1,
                            "name_en": "Electronics",
                            "name_ar": "إلكترونيات",
                            "slug": "electronics",
                            "description_en": "All electronic items",
                            "description_ar": "جميع الأجهزة الإلكترونية",
                            "image": "https://example.com/storage/categories/1.jpg",
                            "status": "active",
                            "created_at": "2023-08-01 10:00:00"
                        },
                        "images": [
                            {
                                "id": 1,
                                "image": "https://example.com/storage/products/1.jpg"
                            }
                        ],
                        "units": [
                            {
                                "id": 1,
                                "name_en": "Piece",
                                "name_ar": "قطعة",
                                "quantity": 50,
                                "price": 1000,
                                "sold_quantity_last_2_days": 10,
                                "buyers_count_last_2_days": 5,
                                "original_price": 1200,
                                "discount": 200,
                                "final_price": 1000,
                                "offer": {
                                    "id": 1,
                                    "title_en": "Summer Sale",
                                    "title_ar": "تخفيضات الصيف",
                                    "description_en": "Up to 200 off",
                                    "description_ar": "خصم يصل إلى 200",
                                    "type": "fixed",
                                    "value": 200,
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            },
                            {
                                "id": 2,
                                "name_en": "Box",
                                "name_ar": "صندوق",
                                "quantity": 10,
                                "price": 5000,
                                "sold_quantity_last_2_days": 2,
                                "buyers_count_last_2_days": 2,
                                "offer": {
                                    "id": 2,
                                    "title_en": "Buy 1 Get 1",
                                    "title_ar": "اشتري 1 واحصل على 1",
                                    "description_en": "Buy 1 Box get 1 Piece free",
                                    "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                    "type": "gift",
                                    "buy_quantity": 1,
                                    "gift_quantity": 1,
                                    "gift_product": {
                                        "product_id": 1,
                                        "unit_id": 1,
                                        "product_name_en": "Smartphone",
                                        "product_name_ar": "هاتف ذكي",
                                        "unit_name_en": "Piece",
                                        "unit_name_ar": "قطعة"
                                    },
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            }
                        ],
                        "created_at": "2023-08-01 10:00:00",
                        "updated_at": "2023-08-01 10:00:00"
                    },
                    "unit": {
                        "id": 1,
                        "name_en": "Piece",
                        "name_ar": "قطعة",
                        "symbol": "pcs",
                        "status": "active"
                    },
                    "quantity": 2,
                    "price": 1000,
                    "total": 2000,
                    "is_gift": false
                }
            ],
            "subtotal": 2000,
            "delivery_fee": 20,
            "discount": 100,
            "total": 1920,
            "payment_method": "cash_on_delivery",
            "payment_status": "pending",
            "coupon": {
                "id": 1,
                "code": "DISCOUNT20",
                "type": "percentage",
                "value": 20
            },
            "coupon_discount": 100,
            "status": "pending",
            "notes": "Deliver after 5 PM",
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Order** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 3. `GET` api/delivery/orders/{id}

**Description:** Get specific delivery order details.

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "order_number": "ORD-123456",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "location": {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        },
        "delivery_driver": {
            "id": 2,
            "name": "Driver Ali",
            "email": "ali@example.com",
            "phone": "+987654321",
            "role": "delivery"
        },
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "role": "customer",
        "items": [
            {
                "id": 1,
                "product": {
                    "id": 1,
                    "name_en": "Smartphone",
                    "name_ar": "هاتف ذكي",
                    "unique_number": "PRD-9876",
                    "barcode": "123456789012",
                    "description_en": "Latest smartphone model",
                    "description_ar": "أحدث موديل هاتف ذكي",
                    "status": true,
                    "category": {
                        "id": 1,
                        "name_en": "Electronics",
                        "name_ar": "إلكترونيات",
                        "slug": "electronics",
                        "description_en": "All electronic items",
                        "description_ar": "جميع الأجهزة الإلكترونية",
                        "image": "https://example.com/storage/categories/1.jpg",
                        "status": "active",
                        "created_at": "2023-08-01 10:00:00"
                    },
                    "images": [
                        {
                            "id": 1,
                            "image": "https://example.com/storage/products/1.jpg"
                        }
                    ],
                    "units": [
                        {
                            "id": 1,
                            "name_en": "Piece",
                            "name_ar": "قطعة",
                            "quantity": 50,
                            "price": 1000,
                            "sold_quantity_last_2_days": 10,
                            "buyers_count_last_2_days": 5,
                            "original_price": 1200,
                            "discount": 200,
                            "final_price": 1000,
                            "offer": {
                                "id": 1,
                                "title_en": "Summer Sale",
                                "title_ar": "تخفيضات الصيف",
                                "description_en": "Up to 200 off",
                                "description_ar": "خصم يصل إلى 200",
                                "type": "fixed",
                                "value": 200,
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        },
                        {
                            "id": 2,
                            "name_en": "Box",
                            "name_ar": "صندوق",
                            "quantity": 10,
                            "price": 5000,
                            "sold_quantity_last_2_days": 2,
                            "buyers_count_last_2_days": 2,
                            "offer": {
                                "id": 2,
                                "title_en": "Buy 1 Get 1",
                                "title_ar": "اشتري 1 واحصل على 1",
                                "description_en": "Buy 1 Box get 1 Piece free",
                                "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                "type": "gift",
                                "buy_quantity": 1,
                                "gift_quantity": 1,
                                "gift_product": {
                                    "product_id": 1,
                                    "unit_id": 1,
                                    "product_name_en": "Smartphone",
                                    "product_name_ar": "هاتف ذكي",
                                    "unit_name_en": "Piece",
                                    "unit_name_ar": "قطعة"
                                },
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        }
                    ],
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                },
                "unit": {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "symbol": "pcs",
                    "status": "active"
                },
                "quantity": 2,
                "price": 1000,
                "total": 2000,
                "is_gift": false
            }
        ],
        "subtotal": 2000,
        "delivery_fee": 20,
        "discount": 100,
        "total": 1920,
        "payment_method": "cash_on_delivery",
        "payment_status": "pending",
        "coupon": {
            "id": 1,
            "code": "DISCOUNT20",
            "type": "percentage",
            "value": 20
        },
        "coupon_discount": 100,
        "status": "pending",
        "notes": "Deliver after 5 PM",
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `data`: The main **Order** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 4. `PATCH` api/delivery/orders/{id}/claim

**Description:** Claim an order for delivery.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "order_number": "ORD-123456",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "location": {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        },
        "delivery_driver": {
            "id": 2,
            "name": "Driver Ali",
            "email": "ali@example.com",
            "phone": "+987654321",
            "role": "delivery"
        },
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "role": "customer",
        "items": [
            {
                "id": 1,
                "product": {
                    "id": 1,
                    "name_en": "Smartphone",
                    "name_ar": "هاتف ذكي",
                    "unique_number": "PRD-9876",
                    "barcode": "123456789012",
                    "description_en": "Latest smartphone model",
                    "description_ar": "أحدث موديل هاتف ذكي",
                    "status": true,
                    "category": {
                        "id": 1,
                        "name_en": "Electronics",
                        "name_ar": "إلكترونيات",
                        "slug": "electronics",
                        "description_en": "All electronic items",
                        "description_ar": "جميع الأجهزة الإلكترونية",
                        "image": "https://example.com/storage/categories/1.jpg",
                        "status": "active",
                        "created_at": "2023-08-01 10:00:00"
                    },
                    "images": [
                        {
                            "id": 1,
                            "image": "https://example.com/storage/products/1.jpg"
                        }
                    ],
                    "units": [
                        {
                            "id": 1,
                            "name_en": "Piece",
                            "name_ar": "قطعة",
                            "quantity": 50,
                            "price": 1000,
                            "sold_quantity_last_2_days": 10,
                            "buyers_count_last_2_days": 5,
                            "original_price": 1200,
                            "discount": 200,
                            "final_price": 1000,
                            "offer": {
                                "id": 1,
                                "title_en": "Summer Sale",
                                "title_ar": "تخفيضات الصيف",
                                "description_en": "Up to 200 off",
                                "description_ar": "خصم يصل إلى 200",
                                "type": "fixed",
                                "value": 200,
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        },
                        {
                            "id": 2,
                            "name_en": "Box",
                            "name_ar": "صندوق",
                            "quantity": 10,
                            "price": 5000,
                            "sold_quantity_last_2_days": 2,
                            "buyers_count_last_2_days": 2,
                            "offer": {
                                "id": 2,
                                "title_en": "Buy 1 Get 1",
                                "title_ar": "اشتري 1 واحصل على 1",
                                "description_en": "Buy 1 Box get 1 Piece free",
                                "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                "type": "gift",
                                "buy_quantity": 1,
                                "gift_quantity": 1,
                                "gift_product": {
                                    "product_id": 1,
                                    "unit_id": 1,
                                    "product_name_en": "Smartphone",
                                    "product_name_ar": "هاتف ذكي",
                                    "unit_name_en": "Piece",
                                    "unit_name_ar": "قطعة"
                                },
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        }
                    ],
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                },
                "unit": {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "symbol": "pcs",
                    "status": "active"
                },
                "quantity": 2,
                "price": 1000,
                "total": 2000,
                "is_gift": false
            }
        ],
        "subtotal": 2000,
        "delivery_fee": 20,
        "discount": 100,
        "total": 1920,
        "payment_method": "cash_on_delivery",
        "payment_status": "pending",
        "coupon": {
            "id": 1,
            "code": "DISCOUNT20",
            "type": "percentage",
            "value": 20
        },
        "coupon_discount": 100,
        "status": "pending",
        "notes": "Deliver after 5 PM",
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Order** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 5. `PATCH` api/delivery/orders/{id}/status

**Description:** Update delivery status.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "order_number": "ORD-123456",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "location": {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        },
        "delivery_driver": {
            "id": 2,
            "name": "Driver Ali",
            "email": "ali@example.com",
            "phone": "+987654321",
            "role": "delivery"
        },
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "role": "customer",
        "items": [
            {
                "id": 1,
                "product": {
                    "id": 1,
                    "name_en": "Smartphone",
                    "name_ar": "هاتف ذكي",
                    "unique_number": "PRD-9876",
                    "barcode": "123456789012",
                    "description_en": "Latest smartphone model",
                    "description_ar": "أحدث موديل هاتف ذكي",
                    "status": true,
                    "category": {
                        "id": 1,
                        "name_en": "Electronics",
                        "name_ar": "إلكترونيات",
                        "slug": "electronics",
                        "description_en": "All electronic items",
                        "description_ar": "جميع الأجهزة الإلكترونية",
                        "image": "https://example.com/storage/categories/1.jpg",
                        "status": "active",
                        "created_at": "2023-08-01 10:00:00"
                    },
                    "images": [
                        {
                            "id": 1,
                            "image": "https://example.com/storage/products/1.jpg"
                        }
                    ],
                    "units": [
                        {
                            "id": 1,
                            "name_en": "Piece",
                            "name_ar": "قطعة",
                            "quantity": 50,
                            "price": 1000,
                            "sold_quantity_last_2_days": 10,
                            "buyers_count_last_2_days": 5,
                            "original_price": 1200,
                            "discount": 200,
                            "final_price": 1000,
                            "offer": {
                                "id": 1,
                                "title_en": "Summer Sale",
                                "title_ar": "تخفيضات الصيف",
                                "description_en": "Up to 200 off",
                                "description_ar": "خصم يصل إلى 200",
                                "type": "fixed",
                                "value": 200,
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        },
                        {
                            "id": 2,
                            "name_en": "Box",
                            "name_ar": "صندوق",
                            "quantity": 10,
                            "price": 5000,
                            "sold_quantity_last_2_days": 2,
                            "buyers_count_last_2_days": 2,
                            "offer": {
                                "id": 2,
                                "title_en": "Buy 1 Get 1",
                                "title_ar": "اشتري 1 واحصل على 1",
                                "description_en": "Buy 1 Box get 1 Piece free",
                                "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                "type": "gift",
                                "buy_quantity": 1,
                                "gift_quantity": 1,
                                "gift_product": {
                                    "product_id": 1,
                                    "unit_id": 1,
                                    "product_name_en": "Smartphone",
                                    "product_name_ar": "هاتف ذكي",
                                    "unit_name_en": "Piece",
                                    "unit_name_ar": "قطعة"
                                },
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        }
                    ],
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                },
                "unit": {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "symbol": "pcs",
                    "status": "active"
                },
                "quantity": 2,
                "price": 1000,
                "total": 2000,
                "is_gift": false
            }
        ],
        "subtotal": 2000,
        "delivery_fee": 20,
        "discount": 100,
        "total": 1920,
        "payment_method": "cash_on_delivery",
        "payment_status": "pending",
        "coupon": {
            "id": 1,
            "code": "DISCOUNT20",
            "type": "percentage",
            "value": 20
        },
        "coupon_discount": 100,
        "status": "pending",
        "notes": "Deliver after 5 PM",
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Order** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

## Favorites

### 1. `GET` api/favorites

**Description:** Get user favorites.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "product": {
                "id": 1,
                "name_en": "Smartphone",
                "name_ar": "هاتف ذكي",
                "unique_number": "PRD-9876",
                "barcode": "123456789012",
                "description_en": "Latest smartphone model",
                "description_ar": "أحدث موديل هاتف ذكي",
                "status": true,
                "category": {
                    "id": 1,
                    "name_en": "Electronics",
                    "name_ar": "إلكترونيات",
                    "slug": "electronics",
                    "description_en": "All electronic items",
                    "description_ar": "جميع الأجهزة الإلكترونية",
                    "image": "https://example.com/storage/categories/1.jpg",
                    "status": "active",
                    "created_at": "2023-08-01 10:00:00"
                },
                "images": [
                    {
                        "id": 1,
                        "image": "https://example.com/storage/products/1.jpg"
                    }
                ],
                "units": [
                    {
                        "id": 1,
                        "name_en": "Piece",
                        "name_ar": "قطعة",
                        "quantity": 50,
                        "price": 1000,
                        "sold_quantity_last_2_days": 10,
                        "buyers_count_last_2_days": 5,
                        "original_price": 1200,
                        "discount": 200,
                        "final_price": 1000,
                        "offer": {
                            "id": 1,
                            "title_en": "Summer Sale",
                            "title_ar": "تخفيضات الصيف",
                            "description_en": "Up to 200 off",
                            "description_ar": "خصم يصل إلى 200",
                            "type": "fixed",
                            "value": 200,
                            "start_date": "2023-08-01",
                            "end_date": "2023-08-31"
                        }
                    },
                    {
                        "id": 2,
                        "name_en": "Box",
                        "name_ar": "صندوق",
                        "quantity": 10,
                        "price": 5000,
                        "sold_quantity_last_2_days": 2,
                        "buyers_count_last_2_days": 2,
                        "offer": {
                            "id": 2,
                            "title_en": "Buy 1 Get 1",
                            "title_ar": "اشتري 1 واحصل على 1",
                            "description_en": "Buy 1 Box get 1 Piece free",
                            "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                            "type": "gift",
                            "buy_quantity": 1,
                            "gift_quantity": 1,
                            "gift_product": {
                                "product_id": 1,
                                "unit_id": 1,
                                "product_name_en": "Smartphone",
                                "product_name_ar": "هاتف ذكي",
                                "unit_name_en": "Piece",
                                "unit_name_ar": "قطعة"
                            },
                            "start_date": "2023-08-01",
                            "end_date": "2023-08-31"
                        }
                    }
                ],
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            },
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Favorite** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the favorite record.
- `product`: The full product object that is favorited.
- `created_at`: When it was added to favorites.
- `updated_at`: When the favorite record was updated.

---

### 2. `POST` api/favorites

**Description:** Add to favorites.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "product": {
            "id": 1,
            "name_en": "Smartphone",
            "name_ar": "هاتف ذكي",
            "unique_number": "PRD-9876",
            "barcode": "123456789012",
            "description_en": "Latest smartphone model",
            "description_ar": "أحدث موديل هاتف ذكي",
            "status": true,
            "category": {
                "id": 1,
                "name_en": "Electronics",
                "name_ar": "إلكترونيات",
                "slug": "electronics",
                "description_en": "All electronic items",
                "description_ar": "جميع الأجهزة الإلكترونية",
                "image": "https://example.com/storage/categories/1.jpg",
                "status": "active",
                "created_at": "2023-08-01 10:00:00"
            },
            "images": [
                {
                    "id": 1,
                    "image": "https://example.com/storage/products/1.jpg"
                }
            ],
            "units": [
                {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "quantity": 50,
                    "price": 1000,
                    "sold_quantity_last_2_days": 10,
                    "buyers_count_last_2_days": 5,
                    "original_price": 1200,
                    "discount": 200,
                    "final_price": 1000,
                    "offer": {
                        "id": 1,
                        "title_en": "Summer Sale",
                        "title_ar": "تخفيضات الصيف",
                        "description_en": "Up to 200 off",
                        "description_ar": "خصم يصل إلى 200",
                        "type": "fixed",
                        "value": 200,
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                },
                {
                    "id": 2,
                    "name_en": "Box",
                    "name_ar": "صندوق",
                    "quantity": 10,
                    "price": 5000,
                    "sold_quantity_last_2_days": 2,
                    "buyers_count_last_2_days": 2,
                    "offer": {
                        "id": 2,
                        "title_en": "Buy 1 Get 1",
                        "title_ar": "اشتري 1 واحصل على 1",
                        "description_en": "Buy 1 Box get 1 Piece free",
                        "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                        "type": "gift",
                        "buy_quantity": 1,
                        "gift_quantity": 1,
                        "gift_product": {
                            "product_id": 1,
                            "unit_id": 1,
                            "product_name_en": "Smartphone",
                            "product_name_ar": "هاتف ذكي",
                            "unit_name_en": "Piece",
                            "unit_name_ar": "قطعة"
                        },
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                }
            ],
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Favorite** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the favorite record.
- `product`: The full product object that is favorited.
- `created_at`: When it was added to favorites.
- `updated_at`: When the favorite record was updated.

---

### 3. `DELETE` api/favorites/{favorite}

**Description:** Remove from favorites.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

## Locations

### 1. `GET` api/locations

**Description:** Get user locations.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Location** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the location.
- `title`: Title given to the location (e.g., Home, Work).
- `address`: Full street address.
- `latitude`: Geographical latitude coordinate.
- `longitude`: Geographical longitude coordinate.
- `is_default`: Boolean indicating if this is the user's default address.
- `created_at`: Creation timestamp.
- `user`: The full user resource this location belongs to.

---

### 2. `POST` api/locations

**Description:** Create a location.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "title": "Home",
        "address": "123 Main St, City, Country",
        "latitude": 24.7136,
        "longitude": 46.6753,
        "is_default": true,
        "created_at": "2023-08-01 10:00:00",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Location** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the location.
- `title`: Title given to the location (e.g., Home, Work).
- `address`: Full street address.
- `latitude`: Geographical latitude coordinate.
- `longitude`: Geographical longitude coordinate.
- `is_default`: Boolean indicating if this is the user's default address.
- `created_at`: Creation timestamp.
- `user`: The full user resource this location belongs to.

---

### 3. `GET` api/locations/{location}

**Description:** Get a specific location.

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "title": "Home",
        "address": "123 Main St, City, Country",
        "latitude": 24.7136,
        "longitude": 46.6753,
        "is_default": true,
        "created_at": "2023-08-01 10:00:00",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    }
}
```

**Detailed Explanation:**

- `data`: The main **Location** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the location.
- `title`: Title given to the location (e.g., Home, Work).
- `address`: Full street address.
- `latitude`: Geographical latitude coordinate.
- `longitude`: Geographical longitude coordinate.
- `is_default`: Boolean indicating if this is the user's default address.
- `created_at`: Creation timestamp.
- `user`: The full user resource this location belongs to.

---

### 4. `PUT|PATCH` api/locations/{location}

**Description:** Update a location.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "title": "Home",
        "address": "123 Main St, City, Country",
        "latitude": 24.7136,
        "longitude": 46.6753,
        "is_default": true,
        "created_at": "2023-08-01 10:00:00",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Location** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the location.
- `title`: Title given to the location (e.g., Home, Work).
- `address`: Full street address.
- `latitude`: Geographical latitude coordinate.
- `longitude`: Geographical longitude coordinate.
- `is_default`: Boolean indicating if this is the user's default address.
- `created_at`: Creation timestamp.
- `user`: The full user resource this location belongs to.

---

### 5. `DELETE` api/locations/{location}

**Description:** Delete a location.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

### 6. `GET` api/locations-admin

**Description:** Get all locations (admin).

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Location** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the location.
- `title`: Title given to the location (e.g., Home, Work).
- `address`: Full street address.
- `latitude`: Geographical latitude coordinate.
- `longitude`: Geographical longitude coordinate.
- `is_default`: Boolean indicating if this is the user's default address.
- `created_at`: Creation timestamp.
- `user`: The full user resource this location belongs to.

---

### 7. `POST` api/locations-admin

**Description:** Create location (admin).

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "title": "Home",
        "address": "123 Main St, City, Country",
        "latitude": 24.7136,
        "longitude": 46.6753,
        "is_default": true,
        "created_at": "2023-08-01 10:00:00",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Location** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the location.
- `title`: Title given to the location (e.g., Home, Work).
- `address`: Full street address.
- `latitude`: Geographical latitude coordinate.
- `longitude`: Geographical longitude coordinate.
- `is_default`: Boolean indicating if this is the user's default address.
- `created_at`: Creation timestamp.
- `user`: The full user resource this location belongs to.

---

### 8. `GET` api/locations-admin/{locations_admin}

**Description:** Get location (admin).

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "title": "Home",
        "address": "123 Main St, City, Country",
        "latitude": 24.7136,
        "longitude": 46.6753,
        "is_default": true,
        "created_at": "2023-08-01 10:00:00",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    }
}
```

**Detailed Explanation:**

- `data`: The main **Location** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the location.
- `title`: Title given to the location (e.g., Home, Work).
- `address`: Full street address.
- `latitude`: Geographical latitude coordinate.
- `longitude`: Geographical longitude coordinate.
- `is_default`: Boolean indicating if this is the user's default address.
- `created_at`: Creation timestamp.
- `user`: The full user resource this location belongs to.

---

### 9. `PUT|PATCH` api/locations-admin/{locations_admin}

**Description:** Update location (admin).

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "title": "Home",
        "address": "123 Main St, City, Country",
        "latitude": 24.7136,
        "longitude": 46.6753,
        "is_default": true,
        "created_at": "2023-08-01 10:00:00",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Location** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the location.
- `title`: Title given to the location (e.g., Home, Work).
- `address`: Full street address.
- `latitude`: Geographical latitude coordinate.
- `longitude`: Geographical longitude coordinate.
- `is_default`: Boolean indicating if this is the user's default address.
- `created_at`: Creation timestamp.
- `user`: The full user resource this location belongs to.

---

### 10. `DELETE` api/locations-admin/{locations_admin}

**Description:** Delete location (admin).

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

## Auth & Users

### 1. `POST` api/login

**Description:** User login.

**Response Example:**

```json
{
    "access_token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "token_type": "bearer",
    "expires_in": 3600,
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "email_verified_at": "2023-08-01 10:00:00",
        "role": "customer",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `access_token`: The JWT authentication token to be included in the header of subsequent requests (`Authorization: Bearer {token}`).
- `token_type`: The type of token, which is usually `bearer`.
- `expires_in`: Time in seconds until the token expires.
- `user`: The authenticated **User** object details.

**Fields in `user` object:**
- `id`: Unique identifier for the user.
- `name`: Full name of the user.
- `email`: User's email address.
- `phone`: User's contact number.
- `email_verified_at`: Timestamp of when the email was verified.
- `role`: Role of the user (e.g., customer, admin, driver).
- `is_active`: Boolean indicating if the account is active.
- `created_at`: Account creation date.
- `updated_at`: Last account update date.

---

### 2. `POST` api/logout

**Description:** User logout.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

### 3. `POST` api/me

**Description:** Get current authenticated user.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "email_verified_at": "2023-08-01 10:00:00",
        "role": "customer",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **User** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the user.
- `name`: Full name of the user.
- `email`: User's email address.
- `phone`: User's contact number.
- `email_verified_at`: Timestamp of when the email was verified.
- `role`: Role of the user (e.g., customer, admin, driver).
- `is_active`: Boolean indicating if the account is active.
- `created_at`: Account creation date.
- `updated_at`: Last account update date.

---

### 4. `POST` api/refresh

**Description:** Refresh authentication token.

**Response Example:**

```json
{
    "access_token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "token_type": "bearer",
    "expires_in": 3600,
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "email_verified_at": "2023-08-01 10:00:00",
        "role": "customer",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `access_token`: The JWT authentication token to be included in the header of subsequent requests (`Authorization: Bearer {token}`).
- `token_type`: The type of token, which is usually `bearer`.
- `expires_in`: Time in seconds until the token expires.
- `user`: The authenticated **User** object details.

**Fields in `user` object:**
- `id`: Unique identifier for the user.
- `name`: Full name of the user.
- `email`: User's email address.
- `phone`: User's contact number.
- `email_verified_at`: Timestamp of when the email was verified.
- `role`: Role of the user (e.g., customer, admin, driver).
- `is_active`: Boolean indicating if the account is active.
- `created_at`: Account creation date.
- `updated_at`: Last account update date.

---

### 5. `POST` api/register

**Description:** Register a new user.

**Response Example:**

```json
{
    "access_token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "token_type": "bearer",
    "expires_in": 3600,
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "email_verified_at": "2023-08-01 10:00:00",
        "role": "customer",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `access_token`: The JWT authentication token to be included in the header of subsequent requests (`Authorization: Bearer {token}`).
- `token_type`: The type of token, which is usually `bearer`.
- `expires_in`: Time in seconds until the token expires.
- `user`: The authenticated **User** object details.

**Fields in `user` object:**
- `id`: Unique identifier for the user.
- `name`: Full name of the user.
- `email`: User's email address.
- `phone`: User's contact number.
- `email_verified_at`: Timestamp of when the email was verified.
- `role`: Role of the user (e.g., customer, admin, driver).
- `is_active`: Boolean indicating if the account is active.
- `created_at`: Account creation date.
- `updated_at`: Last account update date.

---

### 6. `GET` api/verify-email/{id}

**Description:** Verify user email.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

### 7. `GET` api/users

**Description:** Get all users.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **User** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the user.
- `name`: Full name of the user.
- `email`: User's email address.
- `phone`: User's contact number.
- `email_verified_at`: Timestamp of when the email was verified.
- `role`: Role of the user (e.g., customer, admin, driver).
- `is_active`: Boolean indicating if the account is active.
- `created_at`: Account creation date.
- `updated_at`: Last account update date.

---

### 8. `POST` api/users

**Description:** Create a user.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "email_verified_at": "2023-08-01 10:00:00",
        "role": "customer",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **User** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the user.
- `name`: Full name of the user.
- `email`: User's email address.
- `phone`: User's contact number.
- `email_verified_at`: Timestamp of when the email was verified.
- `role`: Role of the user (e.g., customer, admin, driver).
- `is_active`: Boolean indicating if the account is active.
- `created_at`: Account creation date.
- `updated_at`: Last account update date.

---

### 9. `GET` api/users/{user}

**Description:** Get a specific user.

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "email_verified_at": "2023-08-01 10:00:00",
        "role": "customer",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `data`: The main **User** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the user.
- `name`: Full name of the user.
- `email`: User's email address.
- `phone`: User's contact number.
- `email_verified_at`: Timestamp of when the email was verified.
- `role`: Role of the user (e.g., customer, admin, driver).
- `is_active`: Boolean indicating if the account is active.
- `created_at`: Account creation date.
- `updated_at`: Last account update date.

---

### 10. `PUT|PATCH` api/users/{user}

**Description:** Update a user.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "email_verified_at": "2023-08-01 10:00:00",
        "role": "customer",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **User** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the user.
- `name`: Full name of the user.
- `email`: User's email address.
- `phone`: User's contact number.
- `email_verified_at`: Timestamp of when the email was verified.
- `role`: Role of the user (e.g., customer, admin, driver).
- `is_active`: Boolean indicating if the account is active.
- `created_at`: Account creation date.
- `updated_at`: Last account update date.

---

### 11. `DELETE` api/users/{user}

**Description:** Delete a user.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

## Orders

### 1. `GET` api/my-orders

**Description:** Get current user orders.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "order_number": "ORD-123456",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            },
            "location": {
                "id": 1,
                "title": "Home",
                "address": "123 Main St, City, Country",
                "latitude": 24.7136,
                "longitude": 46.6753,
                "is_default": true,
                "created_at": "2023-08-01 10:00:00",
                "user": {
                    "id": 1,
                    "name": "John Doe",
                    "email": "john@example.com",
                    "phone": "+123456789",
                    "email_verified_at": "2023-08-01 10:00:00",
                    "role": "customer",
                    "is_active": true,
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                }
            },
            "delivery_driver": {
                "id": 2,
                "name": "Driver Ali",
                "email": "ali@example.com",
                "phone": "+987654321",
                "role": "delivery"
            },
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "role": "customer",
            "items": [
                {
                    "id": 1,
                    "product": {
                        "id": 1,
                        "name_en": "Smartphone",
                        "name_ar": "هاتف ذكي",
                        "unique_number": "PRD-9876",
                        "barcode": "123456789012",
                        "description_en": "Latest smartphone model",
                        "description_ar": "أحدث موديل هاتف ذكي",
                        "status": true,
                        "category": {
                            "id": 1,
                            "name_en": "Electronics",
                            "name_ar": "إلكترونيات",
                            "slug": "electronics",
                            "description_en": "All electronic items",
                            "description_ar": "جميع الأجهزة الإلكترونية",
                            "image": "https://example.com/storage/categories/1.jpg",
                            "status": "active",
                            "created_at": "2023-08-01 10:00:00"
                        },
                        "images": [
                            {
                                "id": 1,
                                "image": "https://example.com/storage/products/1.jpg"
                            }
                        ],
                        "units": [
                            {
                                "id": 1,
                                "name_en": "Piece",
                                "name_ar": "قطعة",
                                "quantity": 50,
                                "price": 1000,
                                "sold_quantity_last_2_days": 10,
                                "buyers_count_last_2_days": 5,
                                "original_price": 1200,
                                "discount": 200,
                                "final_price": 1000,
                                "offer": {
                                    "id": 1,
                                    "title_en": "Summer Sale",
                                    "title_ar": "تخفيضات الصيف",
                                    "description_en": "Up to 200 off",
                                    "description_ar": "خصم يصل إلى 200",
                                    "type": "fixed",
                                    "value": 200,
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            },
                            {
                                "id": 2,
                                "name_en": "Box",
                                "name_ar": "صندوق",
                                "quantity": 10,
                                "price": 5000,
                                "sold_quantity_last_2_days": 2,
                                "buyers_count_last_2_days": 2,
                                "offer": {
                                    "id": 2,
                                    "title_en": "Buy 1 Get 1",
                                    "title_ar": "اشتري 1 واحصل على 1",
                                    "description_en": "Buy 1 Box get 1 Piece free",
                                    "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                    "type": "gift",
                                    "buy_quantity": 1,
                                    "gift_quantity": 1,
                                    "gift_product": {
                                        "product_id": 1,
                                        "unit_id": 1,
                                        "product_name_en": "Smartphone",
                                        "product_name_ar": "هاتف ذكي",
                                        "unit_name_en": "Piece",
                                        "unit_name_ar": "قطعة"
                                    },
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            }
                        ],
                        "created_at": "2023-08-01 10:00:00",
                        "updated_at": "2023-08-01 10:00:00"
                    },
                    "unit": {
                        "id": 1,
                        "name_en": "Piece",
                        "name_ar": "قطعة",
                        "symbol": "pcs",
                        "status": "active"
                    },
                    "quantity": 2,
                    "price": 1000,
                    "total": 2000,
                    "is_gift": false
                }
            ],
            "subtotal": 2000,
            "delivery_fee": 20,
            "discount": 100,
            "total": 1920,
            "payment_method": "cash_on_delivery",
            "payment_status": "pending",
            "coupon": {
                "id": 1,
                "code": "DISCOUNT20",
                "type": "percentage",
                "value": 20
            },
            "coupon_discount": 100,
            "status": "pending",
            "notes": "Deliver after 5 PM",
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Order** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 2. `GET` api/orders

**Description:** Get all orders.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "order_number": "ORD-123456",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            },
            "location": {
                "id": 1,
                "title": "Home",
                "address": "123 Main St, City, Country",
                "latitude": 24.7136,
                "longitude": 46.6753,
                "is_default": true,
                "created_at": "2023-08-01 10:00:00",
                "user": {
                    "id": 1,
                    "name": "John Doe",
                    "email": "john@example.com",
                    "phone": "+123456789",
                    "email_verified_at": "2023-08-01 10:00:00",
                    "role": "customer",
                    "is_active": true,
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                }
            },
            "delivery_driver": {
                "id": 2,
                "name": "Driver Ali",
                "email": "ali@example.com",
                "phone": "+987654321",
                "role": "delivery"
            },
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "role": "customer",
            "items": [
                {
                    "id": 1,
                    "product": {
                        "id": 1,
                        "name_en": "Smartphone",
                        "name_ar": "هاتف ذكي",
                        "unique_number": "PRD-9876",
                        "barcode": "123456789012",
                        "description_en": "Latest smartphone model",
                        "description_ar": "أحدث موديل هاتف ذكي",
                        "status": true,
                        "category": {
                            "id": 1,
                            "name_en": "Electronics",
                            "name_ar": "إلكترونيات",
                            "slug": "electronics",
                            "description_en": "All electronic items",
                            "description_ar": "جميع الأجهزة الإلكترونية",
                            "image": "https://example.com/storage/categories/1.jpg",
                            "status": "active",
                            "created_at": "2023-08-01 10:00:00"
                        },
                        "images": [
                            {
                                "id": 1,
                                "image": "https://example.com/storage/products/1.jpg"
                            }
                        ],
                        "units": [
                            {
                                "id": 1,
                                "name_en": "Piece",
                                "name_ar": "قطعة",
                                "quantity": 50,
                                "price": 1000,
                                "sold_quantity_last_2_days": 10,
                                "buyers_count_last_2_days": 5,
                                "original_price": 1200,
                                "discount": 200,
                                "final_price": 1000,
                                "offer": {
                                    "id": 1,
                                    "title_en": "Summer Sale",
                                    "title_ar": "تخفيضات الصيف",
                                    "description_en": "Up to 200 off",
                                    "description_ar": "خصم يصل إلى 200",
                                    "type": "fixed",
                                    "value": 200,
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            },
                            {
                                "id": 2,
                                "name_en": "Box",
                                "name_ar": "صندوق",
                                "quantity": 10,
                                "price": 5000,
                                "sold_quantity_last_2_days": 2,
                                "buyers_count_last_2_days": 2,
                                "offer": {
                                    "id": 2,
                                    "title_en": "Buy 1 Get 1",
                                    "title_ar": "اشتري 1 واحصل على 1",
                                    "description_en": "Buy 1 Box get 1 Piece free",
                                    "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                    "type": "gift",
                                    "buy_quantity": 1,
                                    "gift_quantity": 1,
                                    "gift_product": {
                                        "product_id": 1,
                                        "unit_id": 1,
                                        "product_name_en": "Smartphone",
                                        "product_name_ar": "هاتف ذكي",
                                        "unit_name_en": "Piece",
                                        "unit_name_ar": "قطعة"
                                    },
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            }
                        ],
                        "created_at": "2023-08-01 10:00:00",
                        "updated_at": "2023-08-01 10:00:00"
                    },
                    "unit": {
                        "id": 1,
                        "name_en": "Piece",
                        "name_ar": "قطعة",
                        "symbol": "pcs",
                        "status": "active"
                    },
                    "quantity": 2,
                    "price": 1000,
                    "total": 2000,
                    "is_gift": false
                }
            ],
            "subtotal": 2000,
            "delivery_fee": 20,
            "discount": 100,
            "total": 1920,
            "payment_method": "cash_on_delivery",
            "payment_status": "pending",
            "coupon": {
                "id": 1,
                "code": "DISCOUNT20",
                "type": "percentage",
                "value": 20
            },
            "coupon_discount": 100,
            "status": "pending",
            "notes": "Deliver after 5 PM",
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Order** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 3. `POST` api/orders

**Description:** Create an order.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "order_number": "ORD-123456",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "location": {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        },
        "delivery_driver": {
            "id": 2,
            "name": "Driver Ali",
            "email": "ali@example.com",
            "phone": "+987654321",
            "role": "delivery"
        },
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "role": "customer",
        "items": [
            {
                "id": 1,
                "product": {
                    "id": 1,
                    "name_en": "Smartphone",
                    "name_ar": "هاتف ذكي",
                    "unique_number": "PRD-9876",
                    "barcode": "123456789012",
                    "description_en": "Latest smartphone model",
                    "description_ar": "أحدث موديل هاتف ذكي",
                    "status": true,
                    "category": {
                        "id": 1,
                        "name_en": "Electronics",
                        "name_ar": "إلكترونيات",
                        "slug": "electronics",
                        "description_en": "All electronic items",
                        "description_ar": "جميع الأجهزة الإلكترونية",
                        "image": "https://example.com/storage/categories/1.jpg",
                        "status": "active",
                        "created_at": "2023-08-01 10:00:00"
                    },
                    "images": [
                        {
                            "id": 1,
                            "image": "https://example.com/storage/products/1.jpg"
                        }
                    ],
                    "units": [
                        {
                            "id": 1,
                            "name_en": "Piece",
                            "name_ar": "قطعة",
                            "quantity": 50,
                            "price": 1000,
                            "sold_quantity_last_2_days": 10,
                            "buyers_count_last_2_days": 5,
                            "original_price": 1200,
                            "discount": 200,
                            "final_price": 1000,
                            "offer": {
                                "id": 1,
                                "title_en": "Summer Sale",
                                "title_ar": "تخفيضات الصيف",
                                "description_en": "Up to 200 off",
                                "description_ar": "خصم يصل إلى 200",
                                "type": "fixed",
                                "value": 200,
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        },
                        {
                            "id": 2,
                            "name_en": "Box",
                            "name_ar": "صندوق",
                            "quantity": 10,
                            "price": 5000,
                            "sold_quantity_last_2_days": 2,
                            "buyers_count_last_2_days": 2,
                            "offer": {
                                "id": 2,
                                "title_en": "Buy 1 Get 1",
                                "title_ar": "اشتري 1 واحصل على 1",
                                "description_en": "Buy 1 Box get 1 Piece free",
                                "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                "type": "gift",
                                "buy_quantity": 1,
                                "gift_quantity": 1,
                                "gift_product": {
                                    "product_id": 1,
                                    "unit_id": 1,
                                    "product_name_en": "Smartphone",
                                    "product_name_ar": "هاتف ذكي",
                                    "unit_name_en": "Piece",
                                    "unit_name_ar": "قطعة"
                                },
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        }
                    ],
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                },
                "unit": {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "symbol": "pcs",
                    "status": "active"
                },
                "quantity": 2,
                "price": 1000,
                "total": 2000,
                "is_gift": false
            }
        ],
        "subtotal": 2000,
        "delivery_fee": 20,
        "discount": 100,
        "total": 1920,
        "payment_method": "cash_on_delivery",
        "payment_status": "pending",
        "coupon": {
            "id": 1,
            "code": "DISCOUNT20",
            "type": "percentage",
            "value": 20
        },
        "coupon_discount": 100,
        "status": "pending",
        "notes": "Deliver after 5 PM",
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Order** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 4. `POST` api/orders/admin-store

**Description:** Create an order (admin).

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "order_number": "ORD-123456",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "location": {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        },
        "delivery_driver": {
            "id": 2,
            "name": "Driver Ali",
            "email": "ali@example.com",
            "phone": "+987654321",
            "role": "delivery"
        },
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "role": "customer",
        "items": [
            {
                "id": 1,
                "product": {
                    "id": 1,
                    "name_en": "Smartphone",
                    "name_ar": "هاتف ذكي",
                    "unique_number": "PRD-9876",
                    "barcode": "123456789012",
                    "description_en": "Latest smartphone model",
                    "description_ar": "أحدث موديل هاتف ذكي",
                    "status": true,
                    "category": {
                        "id": 1,
                        "name_en": "Electronics",
                        "name_ar": "إلكترونيات",
                        "slug": "electronics",
                        "description_en": "All electronic items",
                        "description_ar": "جميع الأجهزة الإلكترونية",
                        "image": "https://example.com/storage/categories/1.jpg",
                        "status": "active",
                        "created_at": "2023-08-01 10:00:00"
                    },
                    "images": [
                        {
                            "id": 1,
                            "image": "https://example.com/storage/products/1.jpg"
                        }
                    ],
                    "units": [
                        {
                            "id": 1,
                            "name_en": "Piece",
                            "name_ar": "قطعة",
                            "quantity": 50,
                            "price": 1000,
                            "sold_quantity_last_2_days": 10,
                            "buyers_count_last_2_days": 5,
                            "original_price": 1200,
                            "discount": 200,
                            "final_price": 1000,
                            "offer": {
                                "id": 1,
                                "title_en": "Summer Sale",
                                "title_ar": "تخفيضات الصيف",
                                "description_en": "Up to 200 off",
                                "description_ar": "خصم يصل إلى 200",
                                "type": "fixed",
                                "value": 200,
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        },
                        {
                            "id": 2,
                            "name_en": "Box",
                            "name_ar": "صندوق",
                            "quantity": 10,
                            "price": 5000,
                            "sold_quantity_last_2_days": 2,
                            "buyers_count_last_2_days": 2,
                            "offer": {
                                "id": 2,
                                "title_en": "Buy 1 Get 1",
                                "title_ar": "اشتري 1 واحصل على 1",
                                "description_en": "Buy 1 Box get 1 Piece free",
                                "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                "type": "gift",
                                "buy_quantity": 1,
                                "gift_quantity": 1,
                                "gift_product": {
                                    "product_id": 1,
                                    "unit_id": 1,
                                    "product_name_en": "Smartphone",
                                    "product_name_ar": "هاتف ذكي",
                                    "unit_name_en": "Piece",
                                    "unit_name_ar": "قطعة"
                                },
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        }
                    ],
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                },
                "unit": {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "symbol": "pcs",
                    "status": "active"
                },
                "quantity": 2,
                "price": 1000,
                "total": 2000,
                "is_gift": false
            }
        ],
        "subtotal": 2000,
        "delivery_fee": 20,
        "discount": 100,
        "total": 1920,
        "payment_method": "cash_on_delivery",
        "payment_status": "pending",
        "coupon": {
            "id": 1,
            "code": "DISCOUNT20",
            "type": "percentage",
            "value": 20
        },
        "coupon_discount": 100,
        "status": "pending",
        "notes": "Deliver after 5 PM",
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Order** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 5. `GET` api/orders/{order}

**Description:** Get a specific order.

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "order_number": "ORD-123456",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "location": {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        },
        "delivery_driver": {
            "id": 2,
            "name": "Driver Ali",
            "email": "ali@example.com",
            "phone": "+987654321",
            "role": "delivery"
        },
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "role": "customer",
        "items": [
            {
                "id": 1,
                "product": {
                    "id": 1,
                    "name_en": "Smartphone",
                    "name_ar": "هاتف ذكي",
                    "unique_number": "PRD-9876",
                    "barcode": "123456789012",
                    "description_en": "Latest smartphone model",
                    "description_ar": "أحدث موديل هاتف ذكي",
                    "status": true,
                    "category": {
                        "id": 1,
                        "name_en": "Electronics",
                        "name_ar": "إلكترونيات",
                        "slug": "electronics",
                        "description_en": "All electronic items",
                        "description_ar": "جميع الأجهزة الإلكترونية",
                        "image": "https://example.com/storage/categories/1.jpg",
                        "status": "active",
                        "created_at": "2023-08-01 10:00:00"
                    },
                    "images": [
                        {
                            "id": 1,
                            "image": "https://example.com/storage/products/1.jpg"
                        }
                    ],
                    "units": [
                        {
                            "id": 1,
                            "name_en": "Piece",
                            "name_ar": "قطعة",
                            "quantity": 50,
                            "price": 1000,
                            "sold_quantity_last_2_days": 10,
                            "buyers_count_last_2_days": 5,
                            "original_price": 1200,
                            "discount": 200,
                            "final_price": 1000,
                            "offer": {
                                "id": 1,
                                "title_en": "Summer Sale",
                                "title_ar": "تخفيضات الصيف",
                                "description_en": "Up to 200 off",
                                "description_ar": "خصم يصل إلى 200",
                                "type": "fixed",
                                "value": 200,
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        },
                        {
                            "id": 2,
                            "name_en": "Box",
                            "name_ar": "صندوق",
                            "quantity": 10,
                            "price": 5000,
                            "sold_quantity_last_2_days": 2,
                            "buyers_count_last_2_days": 2,
                            "offer": {
                                "id": 2,
                                "title_en": "Buy 1 Get 1",
                                "title_ar": "اشتري 1 واحصل على 1",
                                "description_en": "Buy 1 Box get 1 Piece free",
                                "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                "type": "gift",
                                "buy_quantity": 1,
                                "gift_quantity": 1,
                                "gift_product": {
                                    "product_id": 1,
                                    "unit_id": 1,
                                    "product_name_en": "Smartphone",
                                    "product_name_ar": "هاتف ذكي",
                                    "unit_name_en": "Piece",
                                    "unit_name_ar": "قطعة"
                                },
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        }
                    ],
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                },
                "unit": {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "symbol": "pcs",
                    "status": "active"
                },
                "quantity": 2,
                "price": 1000,
                "total": 2000,
                "is_gift": false
            }
        ],
        "subtotal": 2000,
        "delivery_fee": 20,
        "discount": 100,
        "total": 1920,
        "payment_method": "cash_on_delivery",
        "payment_status": "pending",
        "coupon": {
            "id": 1,
            "code": "DISCOUNT20",
            "type": "percentage",
            "value": 20
        },
        "coupon_discount": 100,
        "status": "pending",
        "notes": "Deliver after 5 PM",
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `data`: The main **Order** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 6. `PUT|PATCH` api/orders/{order}

**Description:** Update an order.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "order_number": "ORD-123456",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "location": {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        },
        "delivery_driver": {
            "id": 2,
            "name": "Driver Ali",
            "email": "ali@example.com",
            "phone": "+987654321",
            "role": "delivery"
        },
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "role": "customer",
        "items": [
            {
                "id": 1,
                "product": {
                    "id": 1,
                    "name_en": "Smartphone",
                    "name_ar": "هاتف ذكي",
                    "unique_number": "PRD-9876",
                    "barcode": "123456789012",
                    "description_en": "Latest smartphone model",
                    "description_ar": "أحدث موديل هاتف ذكي",
                    "status": true,
                    "category": {
                        "id": 1,
                        "name_en": "Electronics",
                        "name_ar": "إلكترونيات",
                        "slug": "electronics",
                        "description_en": "All electronic items",
                        "description_ar": "جميع الأجهزة الإلكترونية",
                        "image": "https://example.com/storage/categories/1.jpg",
                        "status": "active",
                        "created_at": "2023-08-01 10:00:00"
                    },
                    "images": [
                        {
                            "id": 1,
                            "image": "https://example.com/storage/products/1.jpg"
                        }
                    ],
                    "units": [
                        {
                            "id": 1,
                            "name_en": "Piece",
                            "name_ar": "قطعة",
                            "quantity": 50,
                            "price": 1000,
                            "sold_quantity_last_2_days": 10,
                            "buyers_count_last_2_days": 5,
                            "original_price": 1200,
                            "discount": 200,
                            "final_price": 1000,
                            "offer": {
                                "id": 1,
                                "title_en": "Summer Sale",
                                "title_ar": "تخفيضات الصيف",
                                "description_en": "Up to 200 off",
                                "description_ar": "خصم يصل إلى 200",
                                "type": "fixed",
                                "value": 200,
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        },
                        {
                            "id": 2,
                            "name_en": "Box",
                            "name_ar": "صندوق",
                            "quantity": 10,
                            "price": 5000,
                            "sold_quantity_last_2_days": 2,
                            "buyers_count_last_2_days": 2,
                            "offer": {
                                "id": 2,
                                "title_en": "Buy 1 Get 1",
                                "title_ar": "اشتري 1 واحصل على 1",
                                "description_en": "Buy 1 Box get 1 Piece free",
                                "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                "type": "gift",
                                "buy_quantity": 1,
                                "gift_quantity": 1,
                                "gift_product": {
                                    "product_id": 1,
                                    "unit_id": 1,
                                    "product_name_en": "Smartphone",
                                    "product_name_ar": "هاتف ذكي",
                                    "unit_name_en": "Piece",
                                    "unit_name_ar": "قطعة"
                                },
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        }
                    ],
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                },
                "unit": {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "symbol": "pcs",
                    "status": "active"
                },
                "quantity": 2,
                "price": 1000,
                "total": 2000,
                "is_gift": false
            }
        ],
        "subtotal": 2000,
        "delivery_fee": 20,
        "discount": 100,
        "total": 1920,
        "payment_method": "cash_on_delivery",
        "payment_status": "pending",
        "coupon": {
            "id": 1,
            "code": "DISCOUNT20",
            "type": "percentage",
            "value": 20
        },
        "coupon_discount": 100,
        "status": "pending",
        "notes": "Deliver after 5 PM",
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Order** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 7. `DELETE` api/orders/{order}

**Description:** Delete an order.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

### 8. `PATCH` api/orders/{id}/status

**Description:** Update order status.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "order_number": "ORD-123456",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "location": {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        },
        "delivery_driver": {
            "id": 2,
            "name": "Driver Ali",
            "email": "ali@example.com",
            "phone": "+987654321",
            "role": "delivery"
        },
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "role": "customer",
        "items": [
            {
                "id": 1,
                "product": {
                    "id": 1,
                    "name_en": "Smartphone",
                    "name_ar": "هاتف ذكي",
                    "unique_number": "PRD-9876",
                    "barcode": "123456789012",
                    "description_en": "Latest smartphone model",
                    "description_ar": "أحدث موديل هاتف ذكي",
                    "status": true,
                    "category": {
                        "id": 1,
                        "name_en": "Electronics",
                        "name_ar": "إلكترونيات",
                        "slug": "electronics",
                        "description_en": "All electronic items",
                        "description_ar": "جميع الأجهزة الإلكترونية",
                        "image": "https://example.com/storage/categories/1.jpg",
                        "status": "active",
                        "created_at": "2023-08-01 10:00:00"
                    },
                    "images": [
                        {
                            "id": 1,
                            "image": "https://example.com/storage/products/1.jpg"
                        }
                    ],
                    "units": [
                        {
                            "id": 1,
                            "name_en": "Piece",
                            "name_ar": "قطعة",
                            "quantity": 50,
                            "price": 1000,
                            "sold_quantity_last_2_days": 10,
                            "buyers_count_last_2_days": 5,
                            "original_price": 1200,
                            "discount": 200,
                            "final_price": 1000,
                            "offer": {
                                "id": 1,
                                "title_en": "Summer Sale",
                                "title_ar": "تخفيضات الصيف",
                                "description_en": "Up to 200 off",
                                "description_ar": "خصم يصل إلى 200",
                                "type": "fixed",
                                "value": 200,
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        },
                        {
                            "id": 2,
                            "name_en": "Box",
                            "name_ar": "صندوق",
                            "quantity": 10,
                            "price": 5000,
                            "sold_quantity_last_2_days": 2,
                            "buyers_count_last_2_days": 2,
                            "offer": {
                                "id": 2,
                                "title_en": "Buy 1 Get 1",
                                "title_ar": "اشتري 1 واحصل على 1",
                                "description_en": "Buy 1 Box get 1 Piece free",
                                "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                "type": "gift",
                                "buy_quantity": 1,
                                "gift_quantity": 1,
                                "gift_product": {
                                    "product_id": 1,
                                    "unit_id": 1,
                                    "product_name_en": "Smartphone",
                                    "product_name_ar": "هاتف ذكي",
                                    "unit_name_en": "Piece",
                                    "unit_name_ar": "قطعة"
                                },
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        }
                    ],
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                },
                "unit": {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "symbol": "pcs",
                    "status": "active"
                },
                "quantity": 2,
                "price": 1000,
                "total": 2000,
                "is_gift": false
            }
        ],
        "subtotal": 2000,
        "delivery_fee": 20,
        "discount": 100,
        "total": 1920,
        "payment_method": "cash_on_delivery",
        "payment_status": "pending",
        "coupon": {
            "id": 1,
            "code": "DISCOUNT20",
            "type": "percentage",
            "value": 20
        },
        "coupon_discount": 100,
        "status": "pending",
        "notes": "Deliver after 5 PM",
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Order** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 9. `PATCH` api/orders/{id}/delivery-driver

**Description:** Assign delivery driver to order.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "order_number": "ORD-123456",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "location": {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        },
        "delivery_driver": {
            "id": 2,
            "name": "Driver Ali",
            "email": "ali@example.com",
            "phone": "+987654321",
            "role": "delivery"
        },
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "role": "customer",
        "items": [
            {
                "id": 1,
                "product": {
                    "id": 1,
                    "name_en": "Smartphone",
                    "name_ar": "هاتف ذكي",
                    "unique_number": "PRD-9876",
                    "barcode": "123456789012",
                    "description_en": "Latest smartphone model",
                    "description_ar": "أحدث موديل هاتف ذكي",
                    "status": true,
                    "category": {
                        "id": 1,
                        "name_en": "Electronics",
                        "name_ar": "إلكترونيات",
                        "slug": "electronics",
                        "description_en": "All electronic items",
                        "description_ar": "جميع الأجهزة الإلكترونية",
                        "image": "https://example.com/storage/categories/1.jpg",
                        "status": "active",
                        "created_at": "2023-08-01 10:00:00"
                    },
                    "images": [
                        {
                            "id": 1,
                            "image": "https://example.com/storage/products/1.jpg"
                        }
                    ],
                    "units": [
                        {
                            "id": 1,
                            "name_en": "Piece",
                            "name_ar": "قطعة",
                            "quantity": 50,
                            "price": 1000,
                            "sold_quantity_last_2_days": 10,
                            "buyers_count_last_2_days": 5,
                            "original_price": 1200,
                            "discount": 200,
                            "final_price": 1000,
                            "offer": {
                                "id": 1,
                                "title_en": "Summer Sale",
                                "title_ar": "تخفيضات الصيف",
                                "description_en": "Up to 200 off",
                                "description_ar": "خصم يصل إلى 200",
                                "type": "fixed",
                                "value": 200,
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        },
                        {
                            "id": 2,
                            "name_en": "Box",
                            "name_ar": "صندوق",
                            "quantity": 10,
                            "price": 5000,
                            "sold_quantity_last_2_days": 2,
                            "buyers_count_last_2_days": 2,
                            "offer": {
                                "id": 2,
                                "title_en": "Buy 1 Get 1",
                                "title_ar": "اشتري 1 واحصل على 1",
                                "description_en": "Buy 1 Box get 1 Piece free",
                                "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                "type": "gift",
                                "buy_quantity": 1,
                                "gift_quantity": 1,
                                "gift_product": {
                                    "product_id": 1,
                                    "unit_id": 1,
                                    "product_name_en": "Smartphone",
                                    "product_name_ar": "هاتف ذكي",
                                    "unit_name_en": "Piece",
                                    "unit_name_ar": "قطعة"
                                },
                                "start_date": "2023-08-01",
                                "end_date": "2023-08-31"
                            }
                        }
                    ],
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                },
                "unit": {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "symbol": "pcs",
                    "status": "active"
                },
                "quantity": 2,
                "price": 1000,
                "total": 2000,
                "is_gift": false
            }
        ],
        "subtotal": 2000,
        "delivery_fee": 20,
        "discount": 100,
        "total": 1920,
        "payment_method": "cash_on_delivery",
        "payment_status": "pending",
        "coupon": {
            "id": 1,
            "code": "DISCOUNT20",
            "type": "percentage",
            "value": 20
        },
        "coupon_discount": 100,
        "status": "pending",
        "notes": "Deliver after 5 PM",
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Order** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

## Offers

### 1. `GET` api/offers

**Description:** Get all offers.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "title_en": "Buy 1 Get 1 Free",
            "title_ar": "اشتري 1 واحصل على 1 مجانا",
            "description_en": "Limited time offer",
            "description_ar": "عرض لفترة محدودة",
            "image": "https://example.com/storage/offers/1.jpg",
            "type": "gift",
            "value": null,
            "product": {
                "id": 1,
                "name_en": "Smartphone",
                "name_ar": "هاتف ذكي",
                "unique_number": "PRD-9876",
                "barcode": "123456789012",
                "description_en": "Latest smartphone model",
                "description_ar": "أحدث موديل هاتف ذكي",
                "status": true,
                "category": {
                    "id": 1,
                    "name_en": "Electronics",
                    "name_ar": "إلكترونيات",
                    "slug": "electronics",
                    "description_en": "All electronic items",
                    "description_ar": "جميع الأجهزة الإلكترونية",
                    "image": "https://example.com/storage/categories/1.jpg",
                    "status": "active",
                    "created_at": "2023-08-01 10:00:00"
                },
                "images": [
                    {
                        "id": 1,
                        "image": "https://example.com/storage/products/1.jpg"
                    }
                ],
                "units": [
                    {
                        "id": 1,
                        "name_en": "Piece",
                        "name_ar": "قطعة",
                        "quantity": 50,
                        "price": 1000,
                        "sold_quantity_last_2_days": 10,
                        "buyers_count_last_2_days": 5,
                        "original_price": 1200,
                        "discount": 200,
                        "final_price": 1000,
                        "offer": {
                            "id": 1,
                            "title_en": "Summer Sale",
                            "title_ar": "تخفيضات الصيف",
                            "description_en": "Up to 200 off",
                            "description_ar": "خصم يصل إلى 200",
                            "type": "fixed",
                            "value": 200,
                            "start_date": "2023-08-01",
                            "end_date": "2023-08-31"
                        }
                    },
                    {
                        "id": 2,
                        "name_en": "Box",
                        "name_ar": "صندوق",
                        "quantity": 10,
                        "price": 5000,
                        "sold_quantity_last_2_days": 2,
                        "buyers_count_last_2_days": 2,
                        "offer": {
                            "id": 2,
                            "title_en": "Buy 1 Get 1",
                            "title_ar": "اشتري 1 واحصل على 1",
                            "description_en": "Buy 1 Box get 1 Piece free",
                            "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                            "type": "gift",
                            "buy_quantity": 1,
                            "gift_quantity": 1,
                            "gift_product": {
                                "product_id": 1,
                                "unit_id": 1,
                                "product_name_en": "Smartphone",
                                "product_name_ar": "هاتف ذكي",
                                "unit_name_en": "Piece",
                                "unit_name_ar": "قطعة"
                            },
                            "start_date": "2023-08-01",
                            "end_date": "2023-08-31"
                        }
                    }
                ],
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            },
            "start_date": "2023-08-01",
            "end_date": "2023-08-31",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Offer** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the offer.
- `title_en`: Offer title in English.
- `title_ar`: Offer title in Arabic.
- `description_en`: Offer description in English.
- `description_ar`: Offer description in Arabic.
- `image`: URL of the offer banner.
- `type`: Type of the offer (e.g., BOGO, discount).
- `value`: Value of the offer.
- `product`: The full associated product object for the offer.
- `start_date`: Offer start date.
- `end_date`: Offer expiry date.
- `is_active`: Boolean indicating if the offer is active.
- `created_at`: Creation timestamp.
- `updated_at`: Last update timestamp.

---

### 2. `POST` api/offers

**Description:** Create an offer.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "title_en": "Buy 1 Get 1 Free",
        "title_ar": "اشتري 1 واحصل على 1 مجانا",
        "description_en": "Limited time offer",
        "description_ar": "عرض لفترة محدودة",
        "image": "https://example.com/storage/offers/1.jpg",
        "type": "gift",
        "value": null,
        "product": {
            "id": 1,
            "name_en": "Smartphone",
            "name_ar": "هاتف ذكي",
            "unique_number": "PRD-9876",
            "barcode": "123456789012",
            "description_en": "Latest smartphone model",
            "description_ar": "أحدث موديل هاتف ذكي",
            "status": true,
            "category": {
                "id": 1,
                "name_en": "Electronics",
                "name_ar": "إلكترونيات",
                "slug": "electronics",
                "description_en": "All electronic items",
                "description_ar": "جميع الأجهزة الإلكترونية",
                "image": "https://example.com/storage/categories/1.jpg",
                "status": "active",
                "created_at": "2023-08-01 10:00:00"
            },
            "images": [
                {
                    "id": 1,
                    "image": "https://example.com/storage/products/1.jpg"
                }
            ],
            "units": [
                {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "quantity": 50,
                    "price": 1000,
                    "sold_quantity_last_2_days": 10,
                    "buyers_count_last_2_days": 5,
                    "original_price": 1200,
                    "discount": 200,
                    "final_price": 1000,
                    "offer": {
                        "id": 1,
                        "title_en": "Summer Sale",
                        "title_ar": "تخفيضات الصيف",
                        "description_en": "Up to 200 off",
                        "description_ar": "خصم يصل إلى 200",
                        "type": "fixed",
                        "value": 200,
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                },
                {
                    "id": 2,
                    "name_en": "Box",
                    "name_ar": "صندوق",
                    "quantity": 10,
                    "price": 5000,
                    "sold_quantity_last_2_days": 2,
                    "buyers_count_last_2_days": 2,
                    "offer": {
                        "id": 2,
                        "title_en": "Buy 1 Get 1",
                        "title_ar": "اشتري 1 واحصل على 1",
                        "description_en": "Buy 1 Box get 1 Piece free",
                        "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                        "type": "gift",
                        "buy_quantity": 1,
                        "gift_quantity": 1,
                        "gift_product": {
                            "product_id": 1,
                            "unit_id": 1,
                            "product_name_en": "Smartphone",
                            "product_name_ar": "هاتف ذكي",
                            "unit_name_en": "Piece",
                            "unit_name_ar": "قطعة"
                        },
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                }
            ],
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "start_date": "2023-08-01",
        "end_date": "2023-08-31",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Offer** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the offer.
- `title_en`: Offer title in English.
- `title_ar`: Offer title in Arabic.
- `description_en`: Offer description in English.
- `description_ar`: Offer description in Arabic.
- `image`: URL of the offer banner.
- `type`: Type of the offer (e.g., BOGO, discount).
- `value`: Value of the offer.
- `product`: The full associated product object for the offer.
- `start_date`: Offer start date.
- `end_date`: Offer expiry date.
- `is_active`: Boolean indicating if the offer is active.
- `created_at`: Creation timestamp.
- `updated_at`: Last update timestamp.

---

### 3. `GET` api/offers/{offer}

**Description:** Get a specific offer.

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "title_en": "Buy 1 Get 1 Free",
        "title_ar": "اشتري 1 واحصل على 1 مجانا",
        "description_en": "Limited time offer",
        "description_ar": "عرض لفترة محدودة",
        "image": "https://example.com/storage/offers/1.jpg",
        "type": "gift",
        "value": null,
        "product": {
            "id": 1,
            "name_en": "Smartphone",
            "name_ar": "هاتف ذكي",
            "unique_number": "PRD-9876",
            "barcode": "123456789012",
            "description_en": "Latest smartphone model",
            "description_ar": "أحدث موديل هاتف ذكي",
            "status": true,
            "category": {
                "id": 1,
                "name_en": "Electronics",
                "name_ar": "إلكترونيات",
                "slug": "electronics",
                "description_en": "All electronic items",
                "description_ar": "جميع الأجهزة الإلكترونية",
                "image": "https://example.com/storage/categories/1.jpg",
                "status": "active",
                "created_at": "2023-08-01 10:00:00"
            },
            "images": [
                {
                    "id": 1,
                    "image": "https://example.com/storage/products/1.jpg"
                }
            ],
            "units": [
                {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "quantity": 50,
                    "price": 1000,
                    "sold_quantity_last_2_days": 10,
                    "buyers_count_last_2_days": 5,
                    "original_price": 1200,
                    "discount": 200,
                    "final_price": 1000,
                    "offer": {
                        "id": 1,
                        "title_en": "Summer Sale",
                        "title_ar": "تخفيضات الصيف",
                        "description_en": "Up to 200 off",
                        "description_ar": "خصم يصل إلى 200",
                        "type": "fixed",
                        "value": 200,
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                },
                {
                    "id": 2,
                    "name_en": "Box",
                    "name_ar": "صندوق",
                    "quantity": 10,
                    "price": 5000,
                    "sold_quantity_last_2_days": 2,
                    "buyers_count_last_2_days": 2,
                    "offer": {
                        "id": 2,
                        "title_en": "Buy 1 Get 1",
                        "title_ar": "اشتري 1 واحصل على 1",
                        "description_en": "Buy 1 Box get 1 Piece free",
                        "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                        "type": "gift",
                        "buy_quantity": 1,
                        "gift_quantity": 1,
                        "gift_product": {
                            "product_id": 1,
                            "unit_id": 1,
                            "product_name_en": "Smartphone",
                            "product_name_ar": "هاتف ذكي",
                            "unit_name_en": "Piece",
                            "unit_name_ar": "قطعة"
                        },
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                }
            ],
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "start_date": "2023-08-01",
        "end_date": "2023-08-31",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `data`: The main **Offer** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the offer.
- `title_en`: Offer title in English.
- `title_ar`: Offer title in Arabic.
- `description_en`: Offer description in English.
- `description_ar`: Offer description in Arabic.
- `image`: URL of the offer banner.
- `type`: Type of the offer (e.g., BOGO, discount).
- `value`: Value of the offer.
- `product`: The full associated product object for the offer.
- `start_date`: Offer start date.
- `end_date`: Offer expiry date.
- `is_active`: Boolean indicating if the offer is active.
- `created_at`: Creation timestamp.
- `updated_at`: Last update timestamp.

---

### 4. `PUT|PATCH` api/offers/{offer}

**Description:** Update an offer.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "title_en": "Buy 1 Get 1 Free",
        "title_ar": "اشتري 1 واحصل على 1 مجانا",
        "description_en": "Limited time offer",
        "description_ar": "عرض لفترة محدودة",
        "image": "https://example.com/storage/offers/1.jpg",
        "type": "gift",
        "value": null,
        "product": {
            "id": 1,
            "name_en": "Smartphone",
            "name_ar": "هاتف ذكي",
            "unique_number": "PRD-9876",
            "barcode": "123456789012",
            "description_en": "Latest smartphone model",
            "description_ar": "أحدث موديل هاتف ذكي",
            "status": true,
            "category": {
                "id": 1,
                "name_en": "Electronics",
                "name_ar": "إلكترونيات",
                "slug": "electronics",
                "description_en": "All electronic items",
                "description_ar": "جميع الأجهزة الإلكترونية",
                "image": "https://example.com/storage/categories/1.jpg",
                "status": "active",
                "created_at": "2023-08-01 10:00:00"
            },
            "images": [
                {
                    "id": 1,
                    "image": "https://example.com/storage/products/1.jpg"
                }
            ],
            "units": [
                {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "quantity": 50,
                    "price": 1000,
                    "sold_quantity_last_2_days": 10,
                    "buyers_count_last_2_days": 5,
                    "original_price": 1200,
                    "discount": 200,
                    "final_price": 1000,
                    "offer": {
                        "id": 1,
                        "title_en": "Summer Sale",
                        "title_ar": "تخفيضات الصيف",
                        "description_en": "Up to 200 off",
                        "description_ar": "خصم يصل إلى 200",
                        "type": "fixed",
                        "value": 200,
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                },
                {
                    "id": 2,
                    "name_en": "Box",
                    "name_ar": "صندوق",
                    "quantity": 10,
                    "price": 5000,
                    "sold_quantity_last_2_days": 2,
                    "buyers_count_last_2_days": 2,
                    "offer": {
                        "id": 2,
                        "title_en": "Buy 1 Get 1",
                        "title_ar": "اشتري 1 واحصل على 1",
                        "description_en": "Buy 1 Box get 1 Piece free",
                        "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                        "type": "gift",
                        "buy_quantity": 1,
                        "gift_quantity": 1,
                        "gift_product": {
                            "product_id": 1,
                            "unit_id": 1,
                            "product_name_en": "Smartphone",
                            "product_name_ar": "هاتف ذكي",
                            "unit_name_en": "Piece",
                            "unit_name_ar": "قطعة"
                        },
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                }
            ],
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        },
        "start_date": "2023-08-01",
        "end_date": "2023-08-31",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Offer** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the offer.
- `title_en`: Offer title in English.
- `title_ar`: Offer title in Arabic.
- `description_en`: Offer description in English.
- `description_ar`: Offer description in Arabic.
- `image`: URL of the offer banner.
- `type`: Type of the offer (e.g., BOGO, discount).
- `value`: Value of the offer.
- `product`: The full associated product object for the offer.
- `start_date`: Offer start date.
- `end_date`: Offer expiry date.
- `is_active`: Boolean indicating if the offer is active.
- `created_at`: Creation timestamp.
- `updated_at`: Last update timestamp.

---

### 5. `DELETE` api/offers/{offer}

**Description:** Delete an offer.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

## Products

### 1. `GET` api/products

**Description:** Get all products.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "name_en": "Smartphone",
            "name_ar": "هاتف ذكي",
            "unique_number": "PRD-9876",
            "barcode": "123456789012",
            "description_en": "Latest smartphone model",
            "description_ar": "أحدث موديل هاتف ذكي",
            "status": true,
            "category": {
                "id": 1,
                "name_en": "Electronics",
                "name_ar": "إلكترونيات",
                "slug": "electronics",
                "description_en": "All electronic items",
                "description_ar": "جميع الأجهزة الإلكترونية",
                "image": "https://example.com/storage/categories/1.jpg",
                "status": "active",
                "created_at": "2023-08-01 10:00:00"
            },
            "images": [
                {
                    "id": 1,
                    "image": "https://example.com/storage/products/1.jpg"
                }
            ],
            "units": [
                {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "quantity": 50,
                    "price": 1000,
                    "sold_quantity_last_2_days": 10,
                    "buyers_count_last_2_days": 5,
                    "original_price": 1200,
                    "discount": 200,
                    "final_price": 1000,
                    "offer": {
                        "id": 1,
                        "title_en": "Summer Sale",
                        "title_ar": "تخفيضات الصيف",
                        "description_en": "Up to 200 off",
                        "description_ar": "خصم يصل إلى 200",
                        "type": "fixed",
                        "value": 200,
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                },
                {
                    "id": 2,
                    "name_en": "Box",
                    "name_ar": "صندوق",
                    "quantity": 10,
                    "price": 5000,
                    "sold_quantity_last_2_days": 2,
                    "buyers_count_last_2_days": 2,
                    "offer": {
                        "id": 2,
                        "title_en": "Buy 1 Get 1",
                        "title_ar": "اشتري 1 واحصل على 1",
                        "description_en": "Buy 1 Box get 1 Piece free",
                        "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                        "type": "gift",
                        "buy_quantity": 1,
                        "gift_quantity": 1,
                        "gift_product": {
                            "product_id": 1,
                            "unit_id": 1,
                            "product_name_en": "Smartphone",
                            "product_name_ar": "هاتف ذكي",
                            "unit_name_en": "Piece",
                            "unit_name_ar": "قطعة"
                        },
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                }
            ],
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Product** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the product.
- `name_en`: Product name in English.
- `name_ar`: Product name in Arabic.
- `unique_number`: Internal SKU or unique product identifier.
- `barcode`: Barcode number of the product.
- `description_en`: Detailed product description in English.
- `description_ar`: Detailed product description in Arabic.
- `status`: Availability status (boolean).
- `category`: Full Category resource this product belongs to.
- `images`: Array of product images.
- `units`: Available units of measurement for the product along with detailed pricing, sales stats, and active offers.
- `units[].original_price`: (Optional) The original price of the unit before discount.
- `units[].discount`: (Optional) The discount amount applied.
- `units[].final_price`: (Optional) The final price after discount.
- `units[].offer`: (Optional) The active offer (discount or gift) applied to this product unit.

---

### 2. `POST` api/products

**Description:** Create a product.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "name_en": "Smartphone",
        "name_ar": "هاتف ذكي",
        "unique_number": "PRD-9876",
        "barcode": "123456789012",
        "description_en": "Latest smartphone model",
        "description_ar": "أحدث موديل هاتف ذكي",
        "status": true,
        "category": {
            "id": 1,
            "name_en": "Electronics",
            "name_ar": "إلكترونيات",
            "slug": "electronics",
            "description_en": "All electronic items",
            "description_ar": "جميع الأجهزة الإلكترونية",
            "image": "https://example.com/storage/categories/1.jpg",
            "status": "active",
            "created_at": "2023-08-01 10:00:00"
        },
        "images": [
            {
                "id": 1,
                "image": "https://example.com/storage/products/1.jpg"
            }
        ],
        "units": [
            {
                "id": 1,
                "name_en": "Piece",
                "name_ar": "قطعة",
                "quantity": 50,
                "price": 1000,
                "sold_quantity_last_2_days": 10,
                "buyers_count_last_2_days": 5,
                "original_price": 1200,
                "discount": 200,
                "final_price": 1000,
                "offer": {
                    "id": 1,
                    "title_en": "Summer Sale",
                    "title_ar": "تخفيضات الصيف",
                    "description_en": "Up to 200 off",
                    "description_ar": "خصم يصل إلى 200",
                    "type": "fixed",
                    "value": 200,
                    "start_date": "2023-08-01",
                    "end_date": "2023-08-31"
                }
            },
            {
                "id": 2,
                "name_en": "Box",
                "name_ar": "صندوق",
                "quantity": 10,
                "price": 5000,
                "sold_quantity_last_2_days": 2,
                "buyers_count_last_2_days": 2,
                "offer": {
                    "id": 2,
                    "title_en": "Buy 1 Get 1",
                    "title_ar": "اشتري 1 واحصل على 1",
                    "description_en": "Buy 1 Box get 1 Piece free",
                    "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                    "type": "gift",
                    "buy_quantity": 1,
                    "gift_quantity": 1,
                    "gift_product": {
                        "product_id": 1,
                        "unit_id": 1,
                        "product_name_en": "Smartphone",
                        "product_name_ar": "هاتف ذكي",
                        "unit_name_en": "Piece",
                        "unit_name_ar": "قطعة"
                    },
                    "start_date": "2023-08-01",
                    "end_date": "2023-08-31"
                }
            }
        ],
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Product** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the product.
- `name_en`: Product name in English.
- `name_ar`: Product name in Arabic.
- `unique_number`: Internal SKU or unique product identifier.
- `barcode`: Barcode number of the product.
- `description_en`: Detailed product description in English.
- `description_ar`: Detailed product description in Arabic.
- `status`: Availability status (boolean).
- `category`: Full Category resource this product belongs to.
- `images`: Array of product images.
- `units`: Available units of measurement for the product along with detailed pricing, sales stats, and active offers.
- `units[].original_price`: (Optional) The original price of the unit before discount.
- `units[].discount`: (Optional) The discount amount applied.
- `units[].final_price`: (Optional) The final price after discount.
- `units[].offer`: (Optional) The active offer (discount or gift) applied to this product unit.

---

### 3. `GET` api/products/{product}

**Description:** Get a specific product.

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "name_en": "Smartphone",
        "name_ar": "هاتف ذكي",
        "unique_number": "PRD-9876",
        "barcode": "123456789012",
        "description_en": "Latest smartphone model",
        "description_ar": "أحدث موديل هاتف ذكي",
        "status": true,
        "category": {
            "id": 1,
            "name_en": "Electronics",
            "name_ar": "إلكترونيات",
            "slug": "electronics",
            "description_en": "All electronic items",
            "description_ar": "جميع الأجهزة الإلكترونية",
            "image": "https://example.com/storage/categories/1.jpg",
            "status": "active",
            "created_at": "2023-08-01 10:00:00"
        },
        "images": [
            {
                "id": 1,
                "image": "https://example.com/storage/products/1.jpg"
            }
        ],
        "units": [
            {
                "id": 1,
                "name_en": "Piece",
                "name_ar": "قطعة",
                "quantity": 50,
                "price": 1000,
                "sold_quantity_last_2_days": 10,
                "buyers_count_last_2_days": 5,
                "original_price": 1200,
                "discount": 200,
                "final_price": 1000,
                "offer": {
                    "id": 1,
                    "title_en": "Summer Sale",
                    "title_ar": "تخفيضات الصيف",
                    "description_en": "Up to 200 off",
                    "description_ar": "خصم يصل إلى 200",
                    "type": "fixed",
                    "value": 200,
                    "start_date": "2023-08-01",
                    "end_date": "2023-08-31"
                }
            },
            {
                "id": 2,
                "name_en": "Box",
                "name_ar": "صندوق",
                "quantity": 10,
                "price": 5000,
                "sold_quantity_last_2_days": 2,
                "buyers_count_last_2_days": 2,
                "offer": {
                    "id": 2,
                    "title_en": "Buy 1 Get 1",
                    "title_ar": "اشتري 1 واحصل على 1",
                    "description_en": "Buy 1 Box get 1 Piece free",
                    "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                    "type": "gift",
                    "buy_quantity": 1,
                    "gift_quantity": 1,
                    "gift_product": {
                        "product_id": 1,
                        "unit_id": 1,
                        "product_name_en": "Smartphone",
                        "product_name_ar": "هاتف ذكي",
                        "unit_name_en": "Piece",
                        "unit_name_ar": "قطعة"
                    },
                    "start_date": "2023-08-01",
                    "end_date": "2023-08-31"
                }
            }
        ],
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `data`: The main **Product** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the product.
- `name_en`: Product name in English.
- `name_ar`: Product name in Arabic.
- `unique_number`: Internal SKU or unique product identifier.
- `barcode`: Barcode number of the product.
- `description_en`: Detailed product description in English.
- `description_ar`: Detailed product description in Arabic.
- `status`: Availability status (boolean).
- `category`: Full Category resource this product belongs to.
- `images`: Array of product images.
- `units`: Available units of measurement for the product along with detailed pricing, sales stats, and active offers.
- `units[].original_price`: (Optional) The original price of the unit before discount.
- `units[].discount`: (Optional) The discount amount applied.
- `units[].final_price`: (Optional) The final price after discount.
- `units[].offer`: (Optional) The active offer (discount or gift) applied to this product unit.

---

### 4. `PUT|PATCH` api/products/{product}

**Description:** Update a product.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "name_en": "Smartphone",
        "name_ar": "هاتف ذكي",
        "unique_number": "PRD-9876",
        "barcode": "123456789012",
        "description_en": "Latest smartphone model",
        "description_ar": "أحدث موديل هاتف ذكي",
        "status": true,
        "category": {
            "id": 1,
            "name_en": "Electronics",
            "name_ar": "إلكترونيات",
            "slug": "electronics",
            "description_en": "All electronic items",
            "description_ar": "جميع الأجهزة الإلكترونية",
            "image": "https://example.com/storage/categories/1.jpg",
            "status": "active",
            "created_at": "2023-08-01 10:00:00"
        },
        "images": [
            {
                "id": 1,
                "image": "https://example.com/storage/products/1.jpg"
            }
        ],
        "units": [
            {
                "id": 1,
                "name_en": "Piece",
                "name_ar": "قطعة",
                "quantity": 50,
                "price": 1000,
                "sold_quantity_last_2_days": 10,
                "buyers_count_last_2_days": 5,
                "original_price": 1200,
                "discount": 200,
                "final_price": 1000,
                "offer": {
                    "id": 1,
                    "title_en": "Summer Sale",
                    "title_ar": "تخفيضات الصيف",
                    "description_en": "Up to 200 off",
                    "description_ar": "خصم يصل إلى 200",
                    "type": "fixed",
                    "value": 200,
                    "start_date": "2023-08-01",
                    "end_date": "2023-08-31"
                }
            },
            {
                "id": 2,
                "name_en": "Box",
                "name_ar": "صندوق",
                "quantity": 10,
                "price": 5000,
                "sold_quantity_last_2_days": 2,
                "buyers_count_last_2_days": 2,
                "offer": {
                    "id": 2,
                    "title_en": "Buy 1 Get 1",
                    "title_ar": "اشتري 1 واحصل على 1",
                    "description_en": "Buy 1 Box get 1 Piece free",
                    "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                    "type": "gift",
                    "buy_quantity": 1,
                    "gift_quantity": 1,
                    "gift_product": {
                        "product_id": 1,
                        "unit_id": 1,
                        "product_name_en": "Smartphone",
                        "product_name_ar": "هاتف ذكي",
                        "unit_name_en": "Piece",
                        "unit_name_ar": "قطعة"
                    },
                    "start_date": "2023-08-01",
                    "end_date": "2023-08-31"
                }
            }
        ],
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Product** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the product.
- `name_en`: Product name in English.
- `name_ar`: Product name in Arabic.
- `unique_number`: Internal SKU or unique product identifier.
- `barcode`: Barcode number of the product.
- `description_en`: Detailed product description in English.
- `description_ar`: Detailed product description in Arabic.
- `status`: Availability status (boolean).
- `category`: Full Category resource this product belongs to.
- `images`: Array of product images.
- `units`: Available units of measurement for the product along with detailed pricing, sales stats, and active offers.
- `units[].original_price`: (Optional) The original price of the unit before discount.
- `units[].discount`: (Optional) The discount amount applied.
- `units[].final_price`: (Optional) The final price after discount.
- `units[].offer`: (Optional) The active offer (discount or gift) applied to this product unit.

---

### 5. `DELETE` api/products/{product}

**Description:** Delete a product.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

## Reports

### 1. `GET` api/reports/customers

**Description:** Get customers report.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **User** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the user.
- `name`: Full name of the user.
- `email`: User's email address.
- `phone`: User's contact number.
- `email_verified_at`: Timestamp of when the email was verified.
- `role`: Role of the user (e.g., customer, admin, driver).
- `is_active`: Boolean indicating if the account is active.
- `created_at`: Account creation date.
- `updated_at`: Last account update date.

---

### 2. `GET` api/reports/delivery-drivers

**Description:** Get delivery drivers report.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "email_verified_at": "2023-08-01 10:00:00",
            "role": "customer",
            "is_active": true,
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **User** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the user.
- `name`: Full name of the user.
- `email`: User's email address.
- `phone`: User's contact number.
- `email_verified_at`: Timestamp of when the email was verified.
- `role`: Role of the user (e.g., customer, admin, driver).
- `is_active`: Boolean indicating if the account is active.
- `created_at`: Account creation date.
- `updated_at`: Last account update date.

---

### 3. `GET` api/reports/delivery-drivers/{id}

**Description:** Get specific driver report.

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+123456789",
        "email_verified_at": "2023-08-01 10:00:00",
        "role": "customer",
        "is_active": true,
        "created_at": "2023-08-01 10:00:00",
        "updated_at": "2023-08-01 10:00:00"
    }
}
```

**Detailed Explanation:**

- `data`: The main **User** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the user.
- `name`: Full name of the user.
- `email`: User's email address.
- `phone`: User's contact number.
- `email_verified_at`: Timestamp of when the email was verified.
- `role`: Role of the user (e.g., customer, admin, driver).
- `is_active`: Boolean indicating if the account is active.
- `created_at`: Account creation date.
- `updated_at`: Last account update date.

---

### 4. `GET` api/reports/locations

**Description:** Get locations report.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "title": "Home",
            "address": "123 Main St, City, Country",
            "latitude": 24.7136,
            "longitude": 46.6753,
            "is_default": true,
            "created_at": "2023-08-01 10:00:00",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            }
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Location** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the location.
- `title`: Title given to the location (e.g., Home, Work).
- `address`: Full street address.
- `latitude`: Geographical latitude coordinate.
- `longitude`: Geographical longitude coordinate.
- `is_default`: Boolean indicating if this is the user's default address.
- `created_at`: Creation timestamp.
- `user`: The full user resource this location belongs to.

---

### 5. `GET` api/reports/orders

**Description:** Get orders report.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "order_number": "ORD-123456",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            },
            "location": {
                "id": 1,
                "title": "Home",
                "address": "123 Main St, City, Country",
                "latitude": 24.7136,
                "longitude": 46.6753,
                "is_default": true,
                "created_at": "2023-08-01 10:00:00",
                "user": {
                    "id": 1,
                    "name": "John Doe",
                    "email": "john@example.com",
                    "phone": "+123456789",
                    "email_verified_at": "2023-08-01 10:00:00",
                    "role": "customer",
                    "is_active": true,
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                }
            },
            "delivery_driver": {
                "id": 2,
                "name": "Driver Ali",
                "email": "ali@example.com",
                "phone": "+987654321",
                "role": "delivery"
            },
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "role": "customer",
            "items": [
                {
                    "id": 1,
                    "product": {
                        "id": 1,
                        "name_en": "Smartphone",
                        "name_ar": "هاتف ذكي",
                        "unique_number": "PRD-9876",
                        "barcode": "123456789012",
                        "description_en": "Latest smartphone model",
                        "description_ar": "أحدث موديل هاتف ذكي",
                        "status": true,
                        "category": {
                            "id": 1,
                            "name_en": "Electronics",
                            "name_ar": "إلكترونيات",
                            "slug": "electronics",
                            "description_en": "All electronic items",
                            "description_ar": "جميع الأجهزة الإلكترونية",
                            "image": "https://example.com/storage/categories/1.jpg",
                            "status": "active",
                            "created_at": "2023-08-01 10:00:00"
                        },
                        "images": [
                            {
                                "id": 1,
                                "image": "https://example.com/storage/products/1.jpg"
                            }
                        ],
                        "units": [
                            {
                                "id": 1,
                                "name_en": "Piece",
                                "name_ar": "قطعة",
                                "quantity": 50,
                                "price": 1000,
                                "sold_quantity_last_2_days": 10,
                                "buyers_count_last_2_days": 5,
                                "original_price": 1200,
                                "discount": 200,
                                "final_price": 1000,
                                "offer": {
                                    "id": 1,
                                    "title_en": "Summer Sale",
                                    "title_ar": "تخفيضات الصيف",
                                    "description_en": "Up to 200 off",
                                    "description_ar": "خصم يصل إلى 200",
                                    "type": "fixed",
                                    "value": 200,
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            },
                            {
                                "id": 2,
                                "name_en": "Box",
                                "name_ar": "صندوق",
                                "quantity": 10,
                                "price": 5000,
                                "sold_quantity_last_2_days": 2,
                                "buyers_count_last_2_days": 2,
                                "offer": {
                                    "id": 2,
                                    "title_en": "Buy 1 Get 1",
                                    "title_ar": "اشتري 1 واحصل على 1",
                                    "description_en": "Buy 1 Box get 1 Piece free",
                                    "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                    "type": "gift",
                                    "buy_quantity": 1,
                                    "gift_quantity": 1,
                                    "gift_product": {
                                        "product_id": 1,
                                        "unit_id": 1,
                                        "product_name_en": "Smartphone",
                                        "product_name_ar": "هاتف ذكي",
                                        "unit_name_en": "Piece",
                                        "unit_name_ar": "قطعة"
                                    },
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            }
                        ],
                        "created_at": "2023-08-01 10:00:00",
                        "updated_at": "2023-08-01 10:00:00"
                    },
                    "unit": {
                        "id": 1,
                        "name_en": "Piece",
                        "name_ar": "قطعة",
                        "symbol": "pcs",
                        "status": "active"
                    },
                    "quantity": 2,
                    "price": 1000,
                    "total": 2000,
                    "is_gift": false
                }
            ],
            "subtotal": 2000,
            "delivery_fee": 20,
            "discount": 100,
            "total": 1920,
            "payment_method": "cash_on_delivery",
            "payment_status": "pending",
            "coupon": {
                "id": 1,
                "code": "DISCOUNT20",
                "type": "percentage",
                "value": 20
            },
            "coupon_discount": 100,
            "status": "pending",
            "notes": "Deliver after 5 PM",
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Order** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

### 6. `GET` api/reports/products

**Description:** Get products report.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "name_en": "Smartphone",
            "name_ar": "هاتف ذكي",
            "unique_number": "PRD-9876",
            "barcode": "123456789012",
            "description_en": "Latest smartphone model",
            "description_ar": "أحدث موديل هاتف ذكي",
            "status": true,
            "category": {
                "id": 1,
                "name_en": "Electronics",
                "name_ar": "إلكترونيات",
                "slug": "electronics",
                "description_en": "All electronic items",
                "description_ar": "جميع الأجهزة الإلكترونية",
                "image": "https://example.com/storage/categories/1.jpg",
                "status": "active",
                "created_at": "2023-08-01 10:00:00"
            },
            "images": [
                {
                    "id": 1,
                    "image": "https://example.com/storage/products/1.jpg"
                }
            ],
            "units": [
                {
                    "id": 1,
                    "name_en": "Piece",
                    "name_ar": "قطعة",
                    "quantity": 50,
                    "price": 1000,
                    "sold_quantity_last_2_days": 10,
                    "buyers_count_last_2_days": 5,
                    "original_price": 1200,
                    "discount": 200,
                    "final_price": 1000,
                    "offer": {
                        "id": 1,
                        "title_en": "Summer Sale",
                        "title_ar": "تخفيضات الصيف",
                        "description_en": "Up to 200 off",
                        "description_ar": "خصم يصل إلى 200",
                        "type": "fixed",
                        "value": 200,
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                },
                {
                    "id": 2,
                    "name_en": "Box",
                    "name_ar": "صندوق",
                    "quantity": 10,
                    "price": 5000,
                    "sold_quantity_last_2_days": 2,
                    "buyers_count_last_2_days": 2,
                    "offer": {
                        "id": 2,
                        "title_en": "Buy 1 Get 1",
                        "title_ar": "اشتري 1 واحصل على 1",
                        "description_en": "Buy 1 Box get 1 Piece free",
                        "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                        "type": "gift",
                        "buy_quantity": 1,
                        "gift_quantity": 1,
                        "gift_product": {
                            "product_id": 1,
                            "unit_id": 1,
                            "product_name_en": "Smartphone",
                            "product_name_ar": "هاتف ذكي",
                            "unit_name_en": "Piece",
                            "unit_name_ar": "قطعة"
                        },
                        "start_date": "2023-08-01",
                        "end_date": "2023-08-31"
                    }
                }
            ],
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Product** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the product.
- `name_en`: Product name in English.
- `name_ar`: Product name in Arabic.
- `unique_number`: Internal SKU or unique product identifier.
- `barcode`: Barcode number of the product.
- `description_en`: Detailed product description in English.
- `description_ar`: Detailed product description in Arabic.
- `status`: Availability status (boolean).
- `category`: Full Category resource this product belongs to.
- `images`: Array of product images.
- `units`: Available units of measurement for the product along with detailed pricing, sales stats, and active offers.
- `units[].original_price`: (Optional) The original price of the unit before discount.
- `units[].discount`: (Optional) The discount amount applied.
- `units[].final_price`: (Optional) The final price after discount.
- `units[].offer`: (Optional) The active offer (discount or gift) applied to this product unit.

---

### 7. `GET` api/reports/sales

**Description:** Get sales report.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "order_number": "ORD-123456",
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "+123456789",
                "email_verified_at": "2023-08-01 10:00:00",
                "role": "customer",
                "is_active": true,
                "created_at": "2023-08-01 10:00:00",
                "updated_at": "2023-08-01 10:00:00"
            },
            "location": {
                "id": 1,
                "title": "Home",
                "address": "123 Main St, City, Country",
                "latitude": 24.7136,
                "longitude": 46.6753,
                "is_default": true,
                "created_at": "2023-08-01 10:00:00",
                "user": {
                    "id": 1,
                    "name": "John Doe",
                    "email": "john@example.com",
                    "phone": "+123456789",
                    "email_verified_at": "2023-08-01 10:00:00",
                    "role": "customer",
                    "is_active": true,
                    "created_at": "2023-08-01 10:00:00",
                    "updated_at": "2023-08-01 10:00:00"
                }
            },
            "delivery_driver": {
                "id": 2,
                "name": "Driver Ali",
                "email": "ali@example.com",
                "phone": "+987654321",
                "role": "delivery"
            },
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+123456789",
            "role": "customer",
            "items": [
                {
                    "id": 1,
                    "product": {
                        "id": 1,
                        "name_en": "Smartphone",
                        "name_ar": "هاتف ذكي",
                        "unique_number": "PRD-9876",
                        "barcode": "123456789012",
                        "description_en": "Latest smartphone model",
                        "description_ar": "أحدث موديل هاتف ذكي",
                        "status": true,
                        "category": {
                            "id": 1,
                            "name_en": "Electronics",
                            "name_ar": "إلكترونيات",
                            "slug": "electronics",
                            "description_en": "All electronic items",
                            "description_ar": "جميع الأجهزة الإلكترونية",
                            "image": "https://example.com/storage/categories/1.jpg",
                            "status": "active",
                            "created_at": "2023-08-01 10:00:00"
                        },
                        "images": [
                            {
                                "id": 1,
                                "image": "https://example.com/storage/products/1.jpg"
                            }
                        ],
                        "units": [
                            {
                                "id": 1,
                                "name_en": "Piece",
                                "name_ar": "قطعة",
                                "quantity": 50,
                                "price": 1000,
                                "sold_quantity_last_2_days": 10,
                                "buyers_count_last_2_days": 5,
                                "original_price": 1200,
                                "discount": 200,
                                "final_price": 1000,
                                "offer": {
                                    "id": 1,
                                    "title_en": "Summer Sale",
                                    "title_ar": "تخفيضات الصيف",
                                    "description_en": "Up to 200 off",
                                    "description_ar": "خصم يصل إلى 200",
                                    "type": "fixed",
                                    "value": 200,
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            },
                            {
                                "id": 2,
                                "name_en": "Box",
                                "name_ar": "صندوق",
                                "quantity": 10,
                                "price": 5000,
                                "sold_quantity_last_2_days": 2,
                                "buyers_count_last_2_days": 2,
                                "offer": {
                                    "id": 2,
                                    "title_en": "Buy 1 Get 1",
                                    "title_ar": "اشتري 1 واحصل على 1",
                                    "description_en": "Buy 1 Box get 1 Piece free",
                                    "description_ar": "اشتري 1 صندوق واحصل على 1 قطعة مجانا",
                                    "type": "gift",
                                    "buy_quantity": 1,
                                    "gift_quantity": 1,
                                    "gift_product": {
                                        "product_id": 1,
                                        "unit_id": 1,
                                        "product_name_en": "Smartphone",
                                        "product_name_ar": "هاتف ذكي",
                                        "unit_name_en": "Piece",
                                        "unit_name_ar": "قطعة"
                                    },
                                    "start_date": "2023-08-01",
                                    "end_date": "2023-08-31"
                                }
                            }
                        ],
                        "created_at": "2023-08-01 10:00:00",
                        "updated_at": "2023-08-01 10:00:00"
                    },
                    "unit": {
                        "id": 1,
                        "name_en": "Piece",
                        "name_ar": "قطعة",
                        "symbol": "pcs",
                        "status": "active"
                    },
                    "quantity": 2,
                    "price": 1000,
                    "total": 2000,
                    "is_gift": false
                }
            ],
            "subtotal": 2000,
            "delivery_fee": 20,
            "discount": 100,
            "total": 1920,
            "payment_method": "cash_on_delivery",
            "payment_status": "pending",
            "coupon": {
                "id": 1,
                "code": "DISCOUNT20",
                "type": "percentage",
                "value": 20
            },
            "coupon_discount": 100,
            "status": "pending",
            "notes": "Deliver after 5 PM",
            "created_at": "2023-08-01 10:00:00",
            "updated_at": "2023-08-01 10:00:00"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Order** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the order.
- `order_number`: Human-readable order tracking number.
- `user`: Full User resource representing the customer who placed the order.
- `location`: Full Location resource with delivery address details.
- `delivery_driver`: Basic details of the driver assigned to deliver the order.
- `name`: Name of the recipient.
- `email`: Email address of the recipient.
- `phone`: Contact phone number.
- `role`: Role of the user placing the order.
- `items`: Array of full items included in the order (OrderItems).
- `subtotal`: Total cost before fees and discounts.
- `delivery_fee`: Cost of delivery.
- `discount`: General discount applied to the order.
- `total`: Final amount to be paid.
- `payment_method`: Selected method of payment (e.g., cash_on_delivery).
- `payment_status`: Current status of the payment (e.g., pending, paid).
- `coupon`: Basic details of the coupon applied to the order (if any).
- `coupon_discount`: Amount of discount granted by the coupon.
- `status`: Current status of the order (e.g., pending, shipped, delivered).
- `notes`: Special instructions left by the customer.
- `created_at`: When the order was placed.
- `updated_at`: When the order was last updated.

---

## Units

### 1. `GET` api/units

**Description:** Get all units.

**Response Example:**

```json
{
    "data": [
        {
            "id": 1,
            "name_en": "Piece",
            "name_ar": "قطعة",
            "symbol": "pcs",
            "status": "active"
        }
    ],
    "links": {
        "first": "http://example.com/api?page=1",
        "last": "http://example.com/api?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

**Detailed Explanation:**

- `data`: An array containing a list of **Unit** objects.
- `links` & `meta`: Pagination details to navigate through large lists of records.

**Fields in `data` object:**
- `id`: Unique identifier for the unit.
- `name_en`: Unit name in English.
- `name_ar`: Unit name in Arabic.
- `symbol`: Short symbol for the unit (e.g., kg, pcs).
- `status`: Status of the unit (active/inactive).

---

### 2. `POST` api/units

**Description:** Create a unit.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "name_en": "Piece",
        "name_ar": "قطعة",
        "symbol": "pcs",
        "status": "active"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Unit** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the unit.
- `name_en`: Unit name in English.
- `name_ar`: Unit name in Arabic.
- `symbol`: Short symbol for the unit (e.g., kg, pcs).
- `status`: Status of the unit (active/inactive).

---

### 3. `GET` api/units/{unit}

**Description:** Get a specific unit.

**Response Example:**

```json
{
    "data": {
        "id": 1,
        "name_en": "Piece",
        "name_ar": "قطعة",
        "symbol": "pcs",
        "status": "active"
    }
}
```

**Detailed Explanation:**

- `data`: The main **Unit** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the unit.
- `name_en`: Unit name in English.
- `name_ar`: Unit name in Arabic.
- `symbol`: Short symbol for the unit (e.g., kg, pcs).
- `status`: Status of the unit (active/inactive).

---

### 4. `PUT|PATCH` api/units/{unit}

**Description:** Update a unit.

**Response Example:**

```json
{
    "message": "Operation completed successfully.",
    "data": {
        "id": 1,
        "name_en": "Piece",
        "name_ar": "قطعة",
        "symbol": "pcs",
        "status": "active"
    }
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.
- `data`: The main **Unit** object containing the requested details.

**Fields in `data` object:**
- `id`: Unique identifier for the unit.
- `name_en`: Unit name in English.
- `name_ar`: Unit name in Arabic.
- `symbol`: Short symbol for the unit (e.g., kg, pcs).
- `status`: Status of the unit (active/inactive).

---

### 5. `DELETE` api/units/{unit}

**Description:** Delete a unit.

**Response Example:**

```json
{
    "message": "Operation completed successfully."
}
```

**Detailed Explanation:**

- `message`: A descriptive string confirming the result of the operation.


---

