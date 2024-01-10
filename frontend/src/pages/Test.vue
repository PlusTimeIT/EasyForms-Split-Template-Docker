<template>
    <div>
      <!-- Search product input :disabled="!selected_warehouse"-->
      <div class="p-1 dropdown-search-select-box">
        <label class="my-1">Search product</label>
        <input
          
          type="text"
          class="form-control form-control-sm"
          placeholder="Search items..."
          v-model="product_q"
          @keyup="fetchProducts(product_q)"
        />
        <ul class="list-group dropdown-search-list" v-if="items.length > 0">
          <li
            @click="onSelectProduct(p)"
            :key="p.id"
            class="list-group-item cursor-pointer"
            v-for="p in items"
          >
            {{ p.name }}
          </li>
        </ul>
      </div>
  
      <table
      class="table bg-white table-bordered my-3 p-1 table-responsive"
  >
      <thead>
          <tr class="bg-ass text-secondary">
              <th class="min150">Product</th>
              <th class="min100">Unit Price</th>
              <th class="">Stock</th>
              <th class="min100">Quantity</th>
              <th class="min100">Tax</th>
              <th class="min100">Subtotal</th>
              <th class="min100">action</th>
          </tr>
      </thead> 
      {{ selected_items }} 
<tbody v-if="selected_items.length > 0">
  <tr v-for="p in selected_items">
    <td>{{ p.name }}</td>
    <td>{{ p.unit_price }}</td>
    <td>
      <input
        type="number"
        class="max100 form-control"
        :value="p.stock_left"
        disabled
      />
    </td>
    <td>
      <input
        type="number"
        class="max100 form-control"
        min="1"
        v-model="p.order_quantity"
        @input="calculateGrandTotal()"
      />
    </td>
    <td>
      {{
        (
          p.order_quantity *
          ((((100 - p.tax_rate) *
            p.unit_price) /
            100) *
            (p.tax_rate / 100))
          ).toFixed(2)
      }}
      $
    </td>
    <td>
      {{
        p.tax_type == "exclusive"
          ? p.product_quantity *
            (p.sale_price * (p.tax_rate / 100) +
                p.sale_price)
          : p.product_quantity * p.product.sale_price
      }}
    </td>
    <td>
        <CrossSvgIcon
            @click="removeSelected(p.id)"
            color="red"
        />...
    </td>
  </tr>
</tbody>
  </table>
    </div>{{ product_q }}
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
import { computed } from 'vue';

  const product_q = ref('');
  const selected_warehouse = ref(1);
  const items = ref([]);
  const selected_items = ref([]);
  
  async function fetchProducts(name = product_q.value) {
    if (name.length < 1) {
        clearProducts();
        return;
    }
    try {
        const response = await axios.get(`/api/warehouse-products/${selected_warehouse.value}/${name}`);
        items.value = response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
    }
}
  // Fetch invoice products
  const fetchInvoiceProducts = async () => {
    try {
      const response = await axios.get(`/api/products_invoice/14`);
      selected_items.value = response.data;
      console.log(selected_items)
    } catch (error) {
      console.error('Error fetching invoice products:', error);
    }
  };
  
  // Add a new product to the selected items
  function onSelectProduct(product) {
    const existingProduct = selected_items.value.find(
        (item) => item.id === product.id
    );
  
    if (existingProduct) {
      existingProduct.quantity += 1;
    } else {
      product.quantity = 1;
      selected_items.value.push(product);
    }
  
    clearProducts();
    product_q.value = '';
    calculateGrandTotal();
  };

  function productToProductRow(product){
    return {
      name: product.name,
      unit_price: product.sale_price,
      stock_left: product.stock_quantity,
      order_quantity: 1,
      tax: product.tax_rate
    }
  }

  function invoiceToProductRow(invoice){
    return {
      name: invoice.product.name,
      unit_price: invoice.product.sale_price,
      stock_left: invoice.product.stock_quantity,
      order_quantity: 1,
      tax: invoice.tax_rate
    }

  }
  
  // Clear products in the dropdown
  const clearProducts = () => {
    items.value = [];
  };
  
  // Calculate grand total (add your logic here)
  const calculateGrandTotal = () => {
    // Add your logic to calculate the grand total
  };
  
  onMounted(() => {
    // Fetch invoice products when the component is mounted
    fetchInvoiceProducts();
    fetchProducts();
  });

  items.value = response.data.map((invoice) => productToProductRow(invoice));
  </script>
  