users
======

admins
======

category
========

id slug name

brand
=====

id slug name

color
=====

id slug name

supplier
========

id name image description

products
========

id category_id supplier_id name image  discount_price sale_price total_qty like_count view_count

products_review
===============

id products_id users_id rating reviews

products_add_transaction
========================

id supplier_id products_id total_qty

products_orders
===============
id users_id products_id total_qty status('pending','success','cancel')

products_cart
=============

id products_id users_id total_qty