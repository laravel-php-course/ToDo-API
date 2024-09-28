<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <div class="row" id="products-container"></div>
    </div>
    <script>
        fetch('https://jsonplaceholder.typicode.com/posts')
            .then(res => res.json())
            .then(json => {
                const container = document.getElementById('products-container');
                json.forEach(post => {
                    const card = document.createElement('div');
                    card.classList.add('col-md-4', 'mb-4');

                    const cardDiv = document.createElement('div');
                    cardDiv.classList.add('card', 'h-100');

                    const cardBody = document.createElement('div');
                    cardBody.classList.add('card-body', 'd-flex', 'flex-column');

                    const title = document.createElement('h5');
                    title.classList.add('card-title');
                    title.innerText = post.title;

                    const body = document.createElement('p');
                    body.classList.add('card-text', 'flex-grow-1');
                    body.innerText = post.body;

                    cardBody.appendChild(title);
                    cardBody.appendChild(body);
                    cardDiv.appendChild(cardBody);
                    card.appendChild(cardDiv);
                    container.appendChild(card);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</body>
</html>
