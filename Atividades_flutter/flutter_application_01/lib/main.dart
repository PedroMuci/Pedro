import 'package:flutter/material.dart';
import 'second.dart'; // importando o second.dart

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Layout Interativo',
      theme: ThemeData(primarySwatch: Colors.blue),
      initialRoute: '/',
      routes: {
        '/': (context) => const HomePage(),
        '/second': (context) => const SecondPage(),
      },
    );
  }
}

class HomePage extends StatelessWidget {
  const HomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Exemplo Layout Interativo")),
      body: SingleChildScrollView(
        child: Column(
          children: [
            // Imagem da web
            Image.network(
              "https://flutter.github.io/assets-for-api-docs/assets/widgets/owl.jpg",
              width: double.infinity,
              height: 200,
              fit: BoxFit.cover,
            ),

            const SizedBox(height: 16),

            // Row interativo com alerta antes de navegar
            InkWell(
              onTap: () {
                showDialog(
                  context: context,
                  builder: (context) => AlertDialog(
                    title: const Text("Navegar"),
                    content: const Text("Deseja ir para a segunda página?"),
                    actions: [
                      TextButton(
                        onPressed: () => Navigator.pop(context),
                        child: const Text("Cancelar"),
                      ),
                      ElevatedButton(
                        onPressed: () {
                          Navigator.pop(context);
                          Navigator.pushNamed(context, '/second');
                        },
                        child: const Text("Ir"),
                      ),
                    ],
                  ),
                );
              },
              child: Container(
                padding: const EdgeInsets.all(16),
                margin: const EdgeInsets.symmetric(horizontal: 20, vertical: 4),
                decoration: BoxDecoration(
                  border: Border.all(color: Colors.blue, width: 2),
                  borderRadius: BorderRadius.circular(8),
                  color: Colors.blue[50],
                ),
                child: const Center(
                  child: Text(
                    "Row 1",
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                      color: Colors.blue,
                    ),
                  ),
                ),
              ),
            ),

            // Texto explicativo
            Container(
              padding: const EdgeInsets.all(16),
              margin: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: Colors.grey[200],
                borderRadius: BorderRadius.circular(8),
              ),
              child: const Text(
                "Aqui vai o texto explicativo. Agora o Row 1 é clicável e "
                "abre uma confirmação antes de navegar para outra página.",
                textAlign: TextAlign.center,
              ),
            ),
          ],
        ),
      ),
    );
  }
}
