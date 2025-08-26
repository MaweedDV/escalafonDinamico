    <div id="app">
        <elementos-lista :elementos-iniciales='@json($elementos)'></elementos-lista>
    </div>

    <script type="module">
        const { createApp, ref, onMounted } = Vue;

        createApp({
            components: {
                'elementos-lista': {
                    props: ['elementosIniciales'],
                    template: `
                        <div>
                            <ul ref="lista" class="lista">
                                <li v-for="(el, index) in elementos" :key="el.id" :data-id="el.id">
                                    <span class="drag-icon"></span>
                                    @{{ el.nombre_cargo }}
                                </li>
                            </ul>
                            <button @click="guardarOrden">Guardar orden</button>
                        </div>
                    `,
                    setup(props) {
                        const elementos = ref([...props.elementosIniciales]);
                        const lista = ref(null);

                        onMounted(() => {
                            new Sortable(lista.value, {
                                animation: 150,
                                onEnd: () => {
                                    // Rearmar la lista basada en el DOM
                                    const ids = Array.from(lista.value.children).map((li) =>
                                        parseInt(li.dataset.id)
                                    );
                                    elementos.value = ids.map((id) =>
                                        props.elementosIniciales.find((el) => el.id === id)
                                    );
                                }
                            });
                        });

                        const guardarOrden = async () => {
                            const orden = elementos.value.map((el, index) => ({
                                id: el.id,
                                orden: index + 1
                            }));

                            //console.log("Nuevo orden:", orden); // DEBUG

                            await fetch('/admin/escalafon/orden', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ orden })
                            });

                            alert('Orden guardado');
                        };

                        return { elementos, guardarOrden, lista };
                    }
                }
            }
        }).mount('#app');
    </script>

    <style>
       .lista {
            list-style: none;
            padding: 0;
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .lista li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            background-color: #fafafa;
            font-size: 16px;
            color: #333;
            transition: background 0.2s ease;
            cursor: grab;
        }

        .lista li:hover {
            background-color: #f0f0f0;
        }

        .lista li:last-child {
            border-bottom: none;
        }

        .drag-icon {
            flex-shrink: 0;
            width: 16px;
            height: 16px;
            background-image: url('data:image/svg+xml;utf8,<svg fill="gray" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 4a1 1 0 110-2 1 1 0 010 2zm6 0a1 1 0 110-2 1 1 0 010 2zM7 10a1 1 0 110-2 1 1 0 010 2zm6 0a1 1 0 110-2 1 1 0 010 2zM7 16a1 1 0 110-2 1 1 0 010 2zm6 0a1 1 0 110-2 1 1 0 010 2z"/></svg>');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 25px;
            background-color: #6366f1;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        button:hover {
            background-color: #4f46e5;
        }
    </style>
