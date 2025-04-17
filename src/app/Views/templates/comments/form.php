<form id="comment-form" class="form row g-3">
    <input hidden disabled name="id" id="idForm">
    <div class="mb-3">
        <label for="name" class="form-label">Почта:</label>
        <input type="email" class="form-control" id="name" name="name" required>
    </div>
    <div class="toast" role="alert" aria-live="polite" autohide aria-atomic="true" data-delay="4000">
        <div role="alert" aria-live="assertive" aria-atomic="true"></div>
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Текст:</label>
        <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Дата:</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <div>
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
        <button type="button" disabled class="btn btn-danger mb-3">Отмена</button>
    </div>
</form>