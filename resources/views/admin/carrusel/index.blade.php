@extends('layouts.app') {{-- o el layout que uses --}}

@section('content')
<br><br>
<div class="container">
    <h1>Administración de Carrusel</h1>
    
    {{-- Aquí irá tu contenido del carrusel --}}
    <div class="row">
        <div class="col-md-12">
            <p>Vista del carrusel funcionando correctamente.</p>
        </div>
    </div>
</div>
@endsection
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Editor de Carrusel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .admin-header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .admin-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .admin-header p {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .admin-content {
            padding: 30px;
        }

        .section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #3498db;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .add-slide-form {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            border: 2px solid #e9ecef;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .slides-list {
            display: grid;
            gap: 20px;
        }

        .slide-item {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            position: relative;
            transition: all 0.3s ease;
        }

        .slide-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .slide-preview {
            display: grid;
            grid-template-columns: 200px 1fr auto;
            gap: 20px;
            align-items: center;
        }

        .slide-image {
            width: 200px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #ddd;
        }

        .slide-info h3 {
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .slide-info p {
            color: #666;
            margin-bottom: 5px;
        }

        .slide-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .drag-handle {
            cursor: move;
            color: #6c757d;
            font-size: 1.2rem;
            padding: 5px;
        }

        .order-number {
            background: #3498db;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            position: absolute;
            top: -10px;
            left: -10px;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: #f8f9fa;
            border: 2px dashed #ddd;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            border-color: #3498db;
            background: #e3f2fd;
        }

        .preview-container {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 15px;
        }

        .carousel-preview {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .carousel-slide {
            display: none;
            position: relative;
        }

        .carousel-slide.active {
            display: block;
        }

        .carousel-slide img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .carousel-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            color: white;
            padding: 30px 20px 20px;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.9);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .carousel-nav:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-prev {
            left: 10px;
        }

        .carousel-next {
            right: 10px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .slide-preview {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .slide-image {
                width: 100%;
                max-width: 200px;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1>🎠 Editor de Carrusel</h1>
            <p>Gestiona las imágenes y contenido de tu carrusel principal</p>
        </div>

        <div class="admin-content">
            <!-- Formulario para agregar nueva diapositiva -->
            <div class="section">
                <h2 class="section-title">
                    ➕ Agregar Nueva Diapositiva
                </h2>
                
                <div class="add-slide-form">
                    <form id="addSlideForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="slideTitle">Título</label>
                                <input type="text" id="slideTitle" name="title" placeholder="Título de la diapositiva" required>
                            </div>
                            <div class="form-group">
                                <label for="slideDiscount">Porcentaje de Descuento (%)</label>
                                <input type="number" id="slideDiscount" name="discount" min="0" max="100" placeholder="50">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="slideDescription">Descripción</label>
                            <textarea id="slideDescription" name="description" placeholder="Descripción de la diapositiva"></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="slideOffer">Oferta</label>
                                <input type="text" id="slideOffer" name="offer" placeholder="Oferta especial limitada">
                            </div>
                            <div class="form-group">
                                <label for="slideTicker">Ticker</label>
                                <input type="text" id="slideTicker" name="ticker" placeholder="¡Solo por tiempo limitado!">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="slideLink">Enlace (opcional)</label>
                                <input type="url" id="slideLink" name="link" placeholder="https://ejemplo.com">
                            </div>
                            <div class="form-group">
                                <label for="slideStatus">Estado</label>
                                <select id="slideStatus" name="status">
                                    <option value="active">Activo</option>
                                    <option value="inactive">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Imagen</label>
                            <div class="file-input-wrapper">
                                <input type="file" id="slideImage" name="image" accept="image/*" required>
                                <label for="slideImage" class="file-input-label">
                                    📁 Seleccionar imagen
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            ➕ Agregar Diapositiva
                        </button>
                    </form>
                </div>
            </div>

            <!-- Lista de diapositivas existentes -->
            <div class="section">
                <h2 class="section-title">
                    📋 Diapositivas Actuales
                </h2>
                
                <div id="slidesList" class="slides-list">
                    <!-- Las diapositivas se cargarán aquí dinámicamente -->
                </div>
            </div>

            <!-- Vista previa del carrusel -->
            <div class="section">
                <h2 class="section-title">
                    👁️ Vista Previa
                </h2>
                
                <div class="preview-container">
                    <div id="carouselPreview" class="carousel-preview">
                        <button class="carousel-nav carousel-prev" onclick="changeSlide(-1)">‹</button>
                        <div id="carouselSlides">
                            <!-- Las diapositivas de vista previa se cargarán aquí -->
                        </div>
                        <button class="carousel-nav carousel-next" onclick="changeSlide(1)">›</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Datos del carrusel (simulando base de datos)
        let carouselData = [
            {
                id: 1,
                title: "Bienvenido a nuestra tienda",
                description: "Descubre los mejores productos con ofertas increíbles",
                discount: 25,
                offer: "Oferta de bienvenida",
                ticker: "¡Solo para nuevos clientes!",
                image: "https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=400&fit=crop",
                link: "#productos",
                status: "active",
                order: 1
            },
            {
                id: 2,
                title: "Ofertas especiales",
                description: "Hasta 50% de descuento en productos seleccionados",
                discount: 50,
                offer: "Mega descuentos",
                ticker: "¡Por tiempo limitado!",
                image: "https://images.unsplash.com/photo-1607083206869-4c7672e72a8a?w=800&h=400&fit=crop",
                link: "#ofertas",
                status: "active",
                order: 2
            }
        ];

        let currentSlide = 0;

        // Cargar diapositivas al iniciar
        document.addEventListener('DOMContentLoaded', function() {
            renderSlidesList();
            renderCarouselPreview();
        });

        // Manejar formulario de nueva diapositiva
        document.getElementById('addSlideForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const imageFile = formData.get('image');
            
            if (imageFile.size > 0) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const newSlide = {
                        id: Date.now(),
                        title: formData.get('title'),
                        description: formData.get('description'),
                        discount: formData.get('discount'),
                        offer: formData.get('offer'),
                        ticker: formData.get('ticker'),
                        image: e.target.result,
                        link: formData.get('link'),
                        status: formData.get('status'),
                        order: carouselData.length + 1
                    };
                    
                    carouselData.push(newSlide);
                    renderSlidesList();
                    renderCarouselPreview();
                    
                    // Limpiar formulario
                    document.getElementById('addSlideForm').reset();
                    document.querySelector('.file-input-label').textContent = '📁 Seleccionar imagen';
                };
                reader.readAsDataURL(imageFile);
            }
        });

        // Actualizar texto del input de archivo
        document.getElementById('slideImage').addEventListener('change', function(e) {
            const label = document.querySelector('.file-input-label');
            if (e.target.files.length > 0) {
                label.textContent = `📁 ${e.target.files[0].name}`;
            } else {
                label.textContent = '📁 Seleccionar imagen';
            }
        });

        function renderSlidesList() {
            const container = document.getElementById('slidesList');
            
            if (carouselData.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666;">No hay diapositivas configuradas</p>';
                return;
            }
            
            const sortedSlides = [...carouselData].sort((a, b) => a.order - b.order);
            
            container.innerHTML = sortedSlides.map(slide => `
                <div class="slide-item" data-id="${slide.id}">
                    <div class="order-number">${slide.order}</div>
                    <div class="slide-preview">
                        <img src="${slide.image}" alt="${slide.title}" class="slide-image">
                        <div class="slide-info">
                            <h3>${slide.title}</h3>
                            <p><strong>Descripción:</strong> ${slide.description || 'Sin descripción'}</p>
                            <p><strong>Descuento:</strong> ${slide.discount ? slide.discount + '%' : 'Sin descuento'}</p>
                            <p><strong>Oferta:</strong> ${slide.offer || 'Sin oferta'}</p>
                            <p><strong>Ticker:</strong> ${slide.ticker || 'Sin ticker'}</p>
                            <p><strong>Enlace:</strong> ${slide.link || 'Sin enlace'}</p>
                            <span class="status-badge ${slide.status === 'active' ? 'status-active' : 'status-inactive'}">
                                ${slide.status === 'active' ? 'Activo' : 'Inactivo'}
                            </span>
                        </div>
                        <div class="slide-actions">
                            <div class="drag-handle" title="Arrastrar para reordenar">⋮⋮</div>
                            <button class="btn btn-secondary" onclick="editSlide(${slide.id})" title="Editar">
                                ✏️
                            </button>
                            <button class="btn btn-danger" onclick="deleteSlide(${slide.id})" title="Eliminar">
                                🗑️
                            </button>
                            <button class="btn btn-secondary" onclick="toggleSlideStatus(${slide.id})" title="Cambiar estado">
                                ${slide.status === 'active' ? '👁️' : '🙈'}
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function renderCarouselPreview() {
            const container = document.getElementById('carouselSlides');
            const activeSlides = carouselData.filter(slide => slide.status === 'active').sort((a, b) => a.order - b.order);
            
            if (activeSlides.length === 0) {
                container.innerHTML = '<div style="padding: 40px; text-align: center; color: #666;">No hay diapositivas activas para mostrar</div>';
                return;
            }
            
            container.innerHTML = activeSlides.map((slide, index) => `
                <div class="carousel-slide ${index === currentSlide ? 'active' : ''}">
                    <img src="${slide.image}" alt="${slide.title}">
                    <div class="carousel-content">
                        ${slide.discount ? `<div style="position: absolute; top: 20px; right: 20px; background: #e74c3c; color: white; padding: 10px 15px; border-radius: 50px; font-weight: bold; font-size: 1.2rem;">-${slide.discount}%</div>` : ''}
                        ${slide.ticker ? `<div style="background: #f39c12; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.9rem; margin-bottom: 10px; display: inline-block;">${slide.ticker}</div>` : ''}
                        <h3>${slide.title}</h3>
                        <p>${slide.description}</p>
                        ${slide.offer ? `<div style="background: rgba(52, 152, 219, 0.9); padding: 8px 12px; border-radius: 5px; margin: 10px 0; font-weight: bold;">${slide.offer}</div>` : ''}
                        ${slide.link ? `<a href="${slide.link}" style="display: inline-block; background: #3498db; color: white; padding: 10px 20px; border-radius: 25px; text-decoration: none; margin-top: 10px; transition: all 0.3s ease;">Ver más</a>` : ''}
                    </div>
                </div>
            `).join('');
        }

        function changeSlide(direction) {
            const activeSlides = carouselData.filter(slide => slide.status === 'active');
            if (activeSlides.length === 0) return;
            
            currentSlide += direction;
            
            if (currentSlide >= activeSlides.length) {
                currentSlide = 0;
            } else if (currentSlide < 0) {
                currentSlide = activeSlides.length - 1;
            }
            
            renderCarouselPreview();
        }

        function deleteSlide(id) {
            if (confirm('¿Estás seguro de que quieres eliminar esta diapositiva?')) {
                carouselData = carouselData.filter(slide => slide.id !== id);
                renderSlidesList();
                renderCarouselPreview();
            }
        }

        function toggleSlideStatus(id) {
            const slide = carouselData.find(s => s.id === id);
            if (slide) {
                slide.status = slide.status === 'active' ? 'inactive' : 'active';
                renderSlidesList();
                renderCarouselPreview();
            }
        }

        function editSlide(id) {
            const slide = carouselData.find(s => s.id === id);
            if (slide) {
                // Llenar el formulario con los datos existentes
                document.getElementById('slideTitle').value = slide.title;
                document.getElementById('slideDescription').value = slide.description;
                document.getElementById('slideDiscount').value = slide.discount || '';
                document.getElementById('slideOffer').value = slide.offer || '';
                document.getElementById('slideTicker').value = slide.ticker || '';
                document.getElementById('slideLink').value = slide.link || '';
                document.getElementById('slideStatus').value = slide.status;
                
                // Eliminar la diapositiva actual para reemplazarla
                deleteSlide(id);
                
                // Scroll al formulario
                document.querySelector('.add-slide-form').scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Auto-cambio de diapositivas en la vista previa
        setInterval(() => {
            const activeSlides = carouselData.filter(slide => slide.status === 'active');
            if (activeSlides.length > 1) {
                changeSlide(1);
            }
        }, 5000);
    </script>
</body>
</html>