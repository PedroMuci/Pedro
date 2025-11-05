import 'package:flutter/material.dart';

class FollowUpScreen extends StatelessWidget {
  const FollowUpScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Acompanhamento Diário'),
        centerTitle: true,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Registro Diário do Paciente',
              style: TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 16),
            const Text(
              'Nesta tela será possível registrar e acompanhar dados diários dos pacientes, '
              'como níveis de glicemia, doses de insulina, horários de aplicação e observações médicas.',
              style: TextStyle(fontSize: 16),
            ),
            const SizedBox(height: 32),
            Center(
              child: ElevatedButton.icon(
                onPressed: () {
                  ScaffoldMessenger.of(context).showSnackBar(
                    const SnackBar(
                      content: Text('Funcionalidade em desenvolvimento.'),
                    ),
                  );
                },
                icon: const Icon(Icons.add_chart),
                label: const Text('Registrar Acompanhamento'),
                style: ElevatedButton.styleFrom(
                  minimumSize: const Size(250, 50),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
