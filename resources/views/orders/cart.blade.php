<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="w-2/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm  mr-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($cartItems as $item)
                    <div class="relative w-full rounded overflow-hidden shadow-lg my-4 border-gray-100 dark:border-gray-700 border p-4 flex justify-between items-center">
                        <input value="{{ $item->id }}" type="checkbox" class="item-checkbox mr-4" data-price="{{ $item->price }}" onchange="updateTotal()">
                        <p class="font-bold text-lg">
                            <a href="{{ route('courses.show', ['id' => $item->id]) }}" class="text-blue-500 hover:underline">{{ $item->title }}</a>
                        </p>
                        <div>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-500">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="w-1/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm  p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Selected Items:</h3>
                <div id="selected-items" class="mb-4 text-gray-900 dark:text-gray-100">
                    <!-- Selected items will be inserted here -->
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Price: Rp<span id="total-price" class="text-gray-900 dark:text-gray-100">0</span></h3>
                <button id="purchase-button" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded" style="display: none;">Purchase</button>
                <form id="purchase-form" action="{{ route('cart.purchase') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="course_ids" id="course-ids">
                </form>

                <script>
                    document.getElementById('purchase-button').addEventListener('click', function() {
                        let selectedCourseIds = [];
                        document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
                            selectedCourseIds.push(parseInt(checkbox.value));
                        });
                        document.getElementById('course-ids').value = selectedCourseIds.join(',');
                        document.getElementById('purchase-form').submit();
                    });
                </script>
            </div>
        </div>
    </div>

    <script>
        function updateTotal() {
            let total = 0;
            let selectedItemsContainer = document.getElementById('selected-items');
            selectedItemsContainer.innerHTML = '';

            document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
                let price = parseFloat(checkbox.getAttribute('data-price'));
                total += price;

                let itemTitle = checkbox.nextElementSibling.innerText;
                let itemElement = document.createElement('div');
                itemElement.className = 'flex justify-between items-center mb-2';
                itemElement.innerHTML = `<span>${itemTitle}</span><span>Rp${price.toLocaleString('id-ID')}</span>`;
                selectedItemsContainer.appendChild(itemElement);
            });

            document.getElementById('total-price').innerText = total.toLocaleString('id-ID');

            let purchaseButton = document.getElementById('purchase-button');
            if (total > 0) {
                purchaseButton.style.display = 'block';
            } else {
                purchaseButton.style.display = 'none';
            }
        }
    </script>
</x-app-layout>