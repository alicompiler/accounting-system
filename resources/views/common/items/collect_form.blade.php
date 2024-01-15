<div class="ui form"
     style="display: flex;justify-content: space-between;align-items: center;">

    <div class="field">
        <label>المادة</label>
        <select onchange="onItemChange(this);" name="item" id="item" class="ui search dropdown">
            <option value="">اختيار المادة</option>
            @foreach($items as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label>الكمية</label>
        <input type="number" autocomplete="off" name="amount" id="amount">
    </div>

    <div class="field" {{isset($noPrice) ? "style='display : none;'" :""}}>
        <label>السعر</label>
        <input type="number" autocomplete="off"
               {{isset($noPrice) ? "value='0'" : ""}}
               name="price" id="price">
    </div>

    <button onclick="onItemAdd(this)" class="ui labeled icon blue button">
        <i class="plus icon"></i>
        اضافة
    </button>

</div>

<div id="error-message-container" style="display : none;" class="ui error message">
    <div class="header">البيانات غير صحيحة</div>
    <p id="error-message-text"></p>
</div>

<div class="ui divider"></div>
<div class="ui hidden divider"></div>

<table class="ui right aligned striped celled table">
    <thead>
    <tr>
        <th>المادة</th>
        <th>في المخزن</th>
        <th>الكمية</th>
        <th>الوحدة</th>
        <th>السعر</th>
        <th>العمليات</th>
    </tr>
    </thead>
    <tbody id="input-items">

    </tbody>
</table>

<div class="ui divider"></div>


<!--suppress JSUnusedAssignment -->
<script>
    const items = @json($items);
    const itemsDic = {};

    for (let i = 0; i < items.length; i++) {
        itemsDic[items[i].id] = items[i];
    }

    const itemsToStartWith = @json(json_decode(isset($inputtedItems) ? $inputtedItems : "[]"));

</script>

<script>

    const inputtedItems = itemsToStartWith;

    function onItemChange(select) {
        const id = select.value;
        if (id && itemsDic[id]) {
            const item = itemsDic[id];
            const priceElement = document.getElementById('price');
            priceElement.value = item.price;
        }
    }


    function onItemAdd() {

        document.getElementById('error-message-container').style.display = 'none';

        const itemElement = document.getElementById('item');
        const priceElement = document.getElementById('price');
        const amountElement = document.getElementById('amount');

        const itemId = itemElement.value;
        const item = itemsDic[itemId];
        const price = priceElement.value;
        const amount = amountElement.value;


        if (isItemValid(item, price, amount) && !inputtedItems[itemId]) {
            addItem(item, price, amount);
            clearItemInputs();
        } else {
            displayErrorMessage(itemId);
        }
    }

    function clearItemInputs() {
        const itemElement = document.getElementById('item');
        const priceElement = document.getElementById('price');
        const amountElement = document.getElementById('amount');
        itemElement.value = '';
        priceElement.value = '';
        amountElement.value = '';
        $(itemElement).dropdown('clear');
    }

    function isItemValid(item, price, amount) {
        return item && price > 0 && amount > 0;
    }


    function addItem(item, price, amount) {
        inputtedItems[item.id] = {
            item: item, price: price, amount: amount
        };
        renderNewItem(item, price, amount);
    }

    function renderNewItem(item, price, amount) {


        const itemsTableBodyElement = document.getElementById('input-items');
        const tr = document.createElement('tr');
        const nameTd = document.createElement('td');
        nameTd.innerText = item.name;
        const priceTd = document.createElement('td');
        priceTd.innerText = price;
        const amountTd = document.createElement('td');
        amountTd.innerText = amount;

        const existingAmountTd = document.createElement('td');
        existingAmountTd.innerText = item.amount;

        const measurementTd = document.createElement('td');
        measurementTd.innerText = item.measurement;
        const deleteButton = document.createElement('button');
        deleteButton.className = 'ui red basic icon button';
        deleteButton.innerHTML = '<i class="trash icon"></i>';
        deleteButton.onclick = onDeleteItem;
        deleteButton.setAttribute('data-item-id', item.id);
        const actionTd = document.createElement('td');
        actionTd.appendChild(deleteButton);
        tr.id = 'item_id_' + item.id;
        tr.appendChild(nameTd);
        tr.appendChild(amountTd);
        tr.appendChild(existingAmountTd);
        tr.appendChild(measurementTd);
        tr.appendChild(priceTd);
        tr.appendChild(actionTd);
        itemsTableBodyElement.appendChild(tr);
    }

    function displayErrorMessage(itemId) {
        const message = inputtedItems[itemId] ? 'المادة موجودة بالفعل' : 'يرجى التاكد من صحة البيانات المدخلة';
        const errorMessageContainer = document.getElementById('error-message-container');
        const messageText = document.getElementById('error-message-text');
        errorMessageContainer.style.display = 'block';
        messageText.innerText = message;
    }

    function onDeleteItem(e) {
        const button = e.target;
        const itemId = button.getAttribute('data-item-id');
        if (!itemId) return;
        delete inputtedItems[itemId];
        const trId = 'item_id_' + itemId;
        const tr = document.getElementById(trId);
        tr.outerHTML = '';
    }

</script>

<script>
    const keys = Object.keys(inputtedItems);

    for (let i = 0; i < keys.length; i++) {
        const key = keys[i];
        const item = inputtedItems[key];
        renderNewItem(item.item, item.count);
    }
</script>