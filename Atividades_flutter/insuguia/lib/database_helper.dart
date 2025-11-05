import 'package:sqflite/sqflite.dart';
import 'package:path/path.dart';

class DatabaseHelper {
  static final DatabaseHelper instance = DatabaseHelper._init();
  static Database? _database;

  DatabaseHelper._init();

  Future<Database> get database async {
    if (_database != null) return _database!;
    _database = await _initDB('insuguia.db');
    return _database!;
  }

  Future<Database> _initDB(String filePath) async {
    final dbPath = await getDatabasesPath();
    final path = join(dbPath, filePath);

    return await openDatabase(path, version: 1, onCreate: _createDB);
  }

  Future<void> _createDB(Database db, int version) async {
    await db.execute('''
      CREATE TABLE pacientes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        sexo TEXT NOT NULL,
        idade INTEGER NOT NULL,
        peso REAL NOT NULL,
        altura REAL NOT NULL,
        creatinina REAL,
        local_internacao TEXT,
        uso_corticoide INTEGER DEFAULT 0,
        dispositivo TEXT
      )
    ''');
  }

  Future<int> insertPaciente(Map<String, dynamic> data) async {
    final db = await instance.database;
    return await db.insert('pacientes', data);
  }

  Future<List<Map<String, dynamic>>> getPacientes() async {
    final db = await instance.database;
    return await db.query('pacientes', orderBy: 'id DESC');
  }

  Future<int> deletePaciente(int id) async {
    final db = await instance.database;
    return await db.delete('pacientes', where: 'id = ?', whereArgs: [id]);
  }

  Future close() async {
    final db = await instance.database;
    db.close();
  }
}
