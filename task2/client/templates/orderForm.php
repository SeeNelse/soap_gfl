<div class="offset-3 col-6">
  <form method="post">
    <div class="form-group">
      <label for="exampleFormControlInput1">ID авто<span style="color: red;">*</span>:</label>
      <input type="number" class="form-control" name='car_id' placeholder="ID авто" require>
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Имя<span style="color: red;">*</span>:</label>
      <input type="text" class="form-control" name='first_name' placeholder="Имя" require>
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Фамилия<span style="color: red;">*</span>:</label>
      <input type="text" class="form-control" name='last_name' placeholder="Фамилия" require>
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Способ оплаты<span style="color: red;">*</span>:</label>
      <select class="form-control" name='payment_type'>
        <option value="none" disabled selected>Выберите способ оплаты</option>
        <option value="1">Наличные</option>
        <option value="2">Кредитная карта</option>
      </select>
    </div>
    %s
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Заказать</button>
    </div>
  </form>
</div>