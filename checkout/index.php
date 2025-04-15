<?php 
require_once(__DIR__ . "/../config.php"); 

// Redirect if not logged in or is seller
if (!$isLogin) {
    header("Location: /users/login?redirect=/checkout");
    exit;
} else if ($isSeller) {
    header("Location: /seller/index.php");
    exit;
}

// Verify cart has items before proceeding
$cart_check_query = "SELECT COUNT(*) as count FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($cart_check_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_count = $stmt->get_result()->fetch_assoc()['count'];

if ($cart_count == 0) {
    // Redirect to cart page if cart is empty
    header("Location: /cart");
    exit;
}

// Get all user addresses
$addresses = [];
$address_query = "SELECT * FROM address WHERE user_id = $user_id";
$address_result = mysqli_query($conn, $address_query);
if ($address_result) {
    while ($address = mysqli_fetch_assoc($address_result)) {
        $addresses[] = $address;
    }
}

require_once(__DIR__ . "/../layout/header.php");
?>

<style>
  body {
    background-color: #f5f5f5;
    font-family: Roboto, Helvetica, Arial, sans-serif;
  }
  .line-clamp-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
  }
  .address-card.selected {
    border-color: #ee4d2d;
    box-shadow: 0 0 0 1px #ee4d2d;
  }
  .address-card.selected .check-circle {
    display: flex;
  }
</style>

<div class="bg-shopee-gray min-h-screen pb-10">
  <div class="container mx-auto px-4 py-6 max-w-screen-xl">
    <!-- Checkout Steps -->
    <div class="flex justify-center mb-8">
      <div class="w-full max-w-4xl">
        <div class="flex justify-between">
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-shopee-orange text-white flex items-center justify-center mb-2 opacity-60">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
            </div>
            <span class="text-xs text-gray-500">Cart</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-shopee-orange"></div>
          </div>
          
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-shopee-orange text-white flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <span class="text-xs font-medium text-shopee-orange">Address</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-gray-200"></div>
          </div>
          
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <span class="text-xs text-gray-500">Payment</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-gray-200"></div>
          </div>
          
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <span class="text-xs text-gray-500">Complete</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Checkout Content -->
    <div class="max-w-4xl mx-auto">
      <h1 class="text-xl font-medium mb-6">Shipping Address</h1>
      
      <!-- Form container -->
      <div class="bg-white rounded-sm shadow-sm p-6 mb-4">
        <form class="form-default" action="/checkout/delivery_info" method="POST" id="shipping-address-form">
          <input type="hidden" name="_token" value="<?= md5(time()) ?>">
          
          <!-- Addresses Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            
            <!-- Existing Addresses -->
            <?php foreach ($addresses as $address): ?>
            <div class="address-card relative border border-gray-200 rounded p-4 cursor-pointer hover:border-gray-300" onclick="selectAddress(this, <?= $address['id'] ?>)">
              <input type="radio" name="address_id" value="<?= $address['id'] ?>" class="hidden">
              
              <!-- Check mark indicator -->
              <div class="check-circle hidden absolute top-2 right-2 w-5 h-5 bg-shopee-orange rounded-full items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </div>
              
              <!-- Address Content -->
              <div class="mb-2 font-medium">Shipping Address</div>
              <div class="text-sm space-y-1 text-gray-600">
                <div class="flex items-start">
                  <div class="w-20 flex-shrink-0 text-gray-500">Address:</div>
                  <div><?= $address['address'] ?></div>
                </div>
                <div class="flex items-start">
                  <div class="w-20 flex-shrink-0 text-gray-500">Postal code:</div>
                  <div><?= $address['post_code'] ?></div>
                </div>
                <div class="flex items-start">
                  <div class="w-20 flex-shrink-0 text-gray-500">Phone:</div>
                  <div><?= $address['phone'] ?></div>
                </div>
              </div>
              
              <!-- Edit button -->
              <div class="absolute top-2 right-10">
                <button type="button" class="text-gray-500 hover:text-shopee-orange" onclick="editAddress(event, <?= $address['id'] ?>)">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                  </svg>
                </button>
              </div>
            </div>
            <?php endforeach; ?>
            
            <!-- Add New Address -->
            <div class="address-card h-full border border-dashed border-gray-300 rounded p-4 hover:border-gray-400 cursor-pointer flex flex-col items-center justify-center" onclick="addNewAddress()">
              <div class="w-10 h-10 rounded-full bg-shopee-light text-shopee-orange flex items-center justify-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
              </div>
              <div class="text-sm text-gray-500">Add New Address</div>
            </div>
          </div>
          
          <!-- Navigation Buttons -->
          <div class="flex flex-col-reverse sm:flex-row items-center justify-between">
            <a href="/cart" class="text-shopee-orange hover:underline mt-3 sm:mt-0">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              Return to Cart
            </a>
            <button type="submit" class="w-full sm:w-auto bg-shopee-orange text-white py-2.5 px-6 rounded-sm hover:bg-shopee-orange/90">
              Continue to Payment
            </button>
          </div>
        </form>
      </div>
      
      <!-- Order Summary -->
      <div class="bg-white rounded-sm shadow-sm p-6">
        <h2 class="font-medium mb-4 border-b border-gray-100 pb-2">Order Summary</h2>
        <div class="space-y-2 text-sm">
          <?php 
            $subtotal = isset($_SESSION['cart_summary']['subtotal']) ? $_SESSION['cart_summary']['subtotal'] : 0;
            $shipping_cost = isset($_SESSION['cart_summary']['shipping_cost']) ? $_SESSION['cart_summary']['shipping_cost'] : 0;
            $total = isset($_SESSION['cart_summary']['total']) ? $_SESSION['cart_summary']['total'] : 0;
            $total_items = isset($_SESSION['cart_summary']['items']) ? $_SESSION['cart_summary']['items'] : 0;
          ?>
          <div class="flex justify-between">
            <span class="text-gray-500">Subtotal (<?= $total_items ?> items):</span>
            <span>$<?= number_format($subtotal, 0, ',', '.') ?></span>
          </div>
          
          <div class="flex justify-between">
            <span class="text-gray-500">Shipping Fee:</span>
            <span><?= $shipping_cost > 0 ? '$'.number_format($shipping_cost, 0, ',', '.') : 'Free' ?></span>
          </div>
          
          <div class="flex justify-between pt-2 border-t border-gray-100 font-medium">
            <span>Total:</span>
            <span class="text-shopee-orange">$<?= number_format($total, 0, ',', '.') ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- New Address Modal -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" id="new-address-modal">
  <div class="bg-white rounded-md w-full max-w-md mx-4">
    <div class="flex justify-between items-center p-4 border-b border-gray-200">
      <h3 class="font-medium">Add New Address</h3>
      <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal('new-address-modal')">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>
    <form method="POST" action="" class="p-4">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2">Address</label>
        <textarea name="address" required class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-shopee-orange" rows="3" placeholder="Enter your full address"></textarea>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2">Postal Code</label>
        <input type="text" name="postal_code" required class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-shopee-orange" placeholder="Enter postal code">
      </div>
      
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-medium mb-2">Phone Number</label>
        <input type="tel" name="phone" required class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-shopee-orange" placeholder="Enter phone number">
      </div>
      
      <div class="flex justify-end">
        <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded mr-2" onclick="closeModal('new-address-modal')">Cancel</button>
        <button type="submit" name="new_address" class="bg-shopee-orange text-white px-4 py-2 rounded">Save Address</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Address Modal -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" id="edit-address-modal">
  <div class="bg-white rounded-md w-full max-w-md mx-4">
    <div class="flex justify-between items-center p-4 border-b border-gray-200">
      <h3 class="font-medium">Edit Address</h3>
      <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal('edit-address-modal')">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>
    <div id="edit_modal_body" class="p-4">
      <!-- This will be populated by AJAX -->
      <div class="flex items-center justify-center py-8">
        <svg class="animate-spin h-8 w-8 text-shopee-orange" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
      </div>
    </div>
  </div>
</div>

<script>
  // Process new address form submission
  <?php
  if (isset($_POST['new_address'])) {
      $post_code = $_POST['postal_code'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];

      @mysqli_query($conn, "INSERT into address(user_id,post_code,address,phone)values($user_id,'$post_code','$address','$phone')");
      echo "window.location.href='/checkout';";
  }
  ?>
  
  // Address selection
  function selectAddress(element, addressId) {
    // Reset all address cards
    document.querySelectorAll('.address-card').forEach(card => {
      card.classList.remove('selected');
    });
    
    // Mark this address as selected
    element.classList.add('selected');
    
    // Set the radio value
    const radio = element.querySelector('input[type="radio"]');
    radio.checked = true;
  }
  
  // Select first address by default
  document.addEventListener('DOMContentLoaded', function() {
    const firstAddress = document.querySelector('.address-card:not(:last-child)');
    if (firstAddress) {
      const addressId = firstAddress.querySelector('input[type="radio"]').value;
      selectAddress(firstAddress, addressId);
    }
  });
  
  // Show new address modal
  function addNewAddress() {
    document.getElementById('new-address-modal').classList.remove('hidden');
  }
  
  // Edit address
  function editAddress(event, addressId) {
    event.stopPropagation(); // Prevent address selection
    
    // Show edit modal
    document.getElementById('edit-address-modal').classList.remove('hidden');
    
    // Load address data
    fetch(`/users/address_edit.php?id=${addressId}`)
      .then(response => response.json())
      .then(data => {
        if (data.html) {
          document.getElementById('edit_modal_body').innerHTML = data.html;
        } else {
          document.getElementById('edit_modal_body').innerHTML = '<p class="text-red-500">Failed to load address details.</p>';
        }
      })
      .catch(error => {
        console.error('Error:', error);
        document.getElementById('edit_modal_body').innerHTML = '<p class="text-red-500">Failed to load address details.</p>';
      });
  }
  
  // Close modal
  function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
  }
  
  // Form validation before submission
  document.getElementById('shipping-address-form').addEventListener('submit', function(e) {
    const selectedAddress = document.querySelector('input[name="address_id"]:checked');
    if (!selectedAddress) {
      e.preventDefault();
      alert('Please select a shipping address or add a new one.');
    }
  });
</script>

<?php include("../layout/footer.php"); ?>