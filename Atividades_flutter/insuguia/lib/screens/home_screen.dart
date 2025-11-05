import 'package:flutter/material.dart';

class HomeScreen extends StatelessWidget {
  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('InsuGuia Mobile'),
        centerTitle: true,
      ),
      body: Padding(
        padding: const EdgeInsets.all(24.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            const SizedBox(height: 24),
            const Text(
              'Bem-vindo ao InsuGuia Mobile!',
              style: TextStyle(
                fontSize: 22,
                fontWeight: FontWeight.bold,
              ),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 24),

            ElevatedButton.icon(
              onPressed: () {
                Navigator.pushNamed(context, '/patient-form');
              },
              icon: const Icon(Icons.person_add),
              label: const Padding(
                padding: EdgeInsets.symmetric(vertical: 14.0),
                child: Text('Cadastrar Paciente', style: TextStyle(fontSize: 16)),
              ),
              style: ElevatedButton.styleFrom(minimumSize: const Size.fromHeight(48)),
            ),
            const SizedBox(height: 12),

            ElevatedButton.icon(
              onPressed: () {
                Navigator.pushNamed(context, '/patient-list');
              },
              icon: const Icon(Icons.list),
              label: const Padding(
                padding: EdgeInsets.symmetric(vertical: 14.0),
                child: Text('Lista de Pacientes', style: TextStyle(fontSize: 16)),
              ),
              style: ElevatedButton.styleFrom(minimumSize: const Size.fromHeight(48)),
            ),
            const SizedBox(height: 12),

            ElevatedButton.icon(
              onPressed: () {
                Navigator.pushNamed(context, '/follow-up');
              },
              icon: const Icon(Icons.timeline),
              label: const Padding(
                padding: EdgeInsets.symmetric(vertical: 14.0),
                child: Text('Acompanhamento Diário', style: TextStyle(fontSize: 16)),
              ),
              style: ElevatedButton.styleFrom(minimumSize: const Size.fromHeight(48)),
            ),
            const SizedBox(height: 12),

            ElevatedButton.icon(
              onPressed: () {
                Navigator.pushNamed(context, '/about');
              },
              icon: const Icon(Icons.info_outline),
              label: const Padding(
                padding: EdgeInsets.symmetric(vertical: 14.0),
                child: Text('Sobre o InsuGuia', style: TextStyle(fontSize: 16)),
              ),
              style: ElevatedButton.styleFrom(minimumSize: const Size.fromHeight(48)),
            ),

            const Spacer(),

            Padding(
              padding: const EdgeInsets.only(bottom: 12.0),
              child: Text(
                'Versão 1.0.0  •  Protótipo acadêmico',
                textAlign: TextAlign.center,
                style: Theme.of(context).textTheme.bodySmall,
              ),
            ),
          ],
        ),
      ),
    );
  }
}
