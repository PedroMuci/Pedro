import 'package:flutter/material.dart';


const _shimmerGradient = LinearGradient(
  colors: [Color(0xFF222222), Color(0xFF444444), Color(0xFF222222)],
  stops: [0.1, 0.3, 0.4],
  begin: Alignment(-1.0, -0.3),
  end: Alignment(1.0, 0.3),
  tileMode: TileMode.clamp,
);


class SecondPage extends StatefulWidget {
  const SecondPage({super.key});

  @override
  State<SecondPage> createState() => _SecondPageState();
}

class _SecondPageState extends State<SecondPage> {
  bool _isLoading = true;

  void _toggleLoading() {
    setState(() {
      _isLoading = !_isLoading;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Segunda Página - Shimmer")),
      backgroundColor: Colors.black, 
      body: Shimmer(
        linearGradient: _shimmerGradient,
        child: ListView(
          physics: _isLoading ? const NeverScrollableScrollPhysics() : null,
          children: [
            const SizedBox(height: 16),
            _buildTopRowList(),
            const SizedBox(height: 16),
            _buildListItem(),
            _buildListItem(),
            _buildListItem(),
          ],
        ),
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: _toggleLoading,
        child: Icon(_isLoading ? Icons.hourglass_full : Icons.check),
      ),
    );
  }

  Widget _buildTopRowList() {
    return SizedBox(
      height: 72,
      child: ListView(
        physics: _isLoading ? const NeverScrollableScrollPhysics() : null,
        scrollDirection: Axis.horizontal,
        shrinkWrap: true,
        children: [
          const SizedBox(width: 16),
          _buildTopRowItem(),
          _buildTopRowItem(),
          _buildTopRowItem(),
          _buildTopRowItem(),
        ],
      ),
    );
  }

  Widget _buildTopRowItem() {
    return ShimmerLoading(
      isLoading: _isLoading,
      child: TriangleListItem(isLoading: _isLoading),
    );
  }

  Widget _buildListItem() {
    return ShimmerLoading(
      isLoading: _isLoading,
      child: CardListItem(isLoading: _isLoading),
    );
  }
}


class Shimmer extends StatefulWidget {
  static ShimmerState? of(BuildContext context) {
    return context.findAncestorStateOfType<ShimmerState>();
  }

  const Shimmer({super.key, required this.linearGradient, this.child});

  final LinearGradient linearGradient;
  final Widget? child;

  @override
  ShimmerState createState() => ShimmerState();
}

class ShimmerState extends State<Shimmer> with SingleTickerProviderStateMixin {
  late AnimationController _shimmerController;

  @override
  void initState() {
    super.initState();

    _shimmerController = AnimationController.unbounded(vsync: this)
      ..repeat(min: -0.5, max: 1.5, period: const Duration(milliseconds: 1200));
  }

  @override
  void dispose() {
    _shimmerController.dispose();
    super.dispose();
  }

  LinearGradient get gradient => LinearGradient(
        colors: widget.linearGradient.colors,
        stops: widget.linearGradient.stops,
        begin: widget.linearGradient.begin,
        end: widget.linearGradient.end,
        transform: _SlidingGradientTransform(
          slidePercent: _shimmerController.value,
        ),
      );

  bool get isSized =>
      (context.findRenderObject() as RenderBox?)?.hasSize ?? false;

  Size get size => (context.findRenderObject() as RenderBox).size;

  Offset getDescendantOffset({
    required RenderBox descendant,
    Offset offset = Offset.zero,
  }) {
    final shimmerBox = context.findRenderObject() as RenderBox?;
    return descendant.localToGlobal(offset, ancestor: shimmerBox);
  }

  Listenable get shimmerChanges => _shimmerController;

  @override
  Widget build(BuildContext context) {
    return widget.child ?? const SizedBox();
  }
}

class _SlidingGradientTransform extends GradientTransform {
  const _SlidingGradientTransform({required this.slidePercent});
  final double slidePercent;

  @override
  Matrix4? transform(Rect bounds, {TextDirection? textDirection}) {
    return Matrix4.translationValues(bounds.width * slidePercent, 0.0, 0.0);
  }
}

class ShimmerLoading extends StatefulWidget {
  const ShimmerLoading({
    super.key,
    required this.isLoading,
    required this.child,
  });

  final bool isLoading;
  final Widget child;

  @override
  State<ShimmerLoading> createState() => _ShimmerLoadingState();
}

class _ShimmerLoadingState extends State<ShimmerLoading> {
  Listenable? _shimmerChanges;

  @override
  void didChangeDependencies() {
    super.didChangeDependencies();
    _shimmerChanges?.removeListener(_onShimmerChange);
    _shimmerChanges = Shimmer.of(context)?.shimmerChanges;
    _shimmerChanges?.addListener(_onShimmerChange);
  }

  @override
  void dispose() {
    _shimmerChanges?.removeListener(_onShimmerChange);
    super.dispose();
  }

  void _onShimmerChange() {
    if (widget.isLoading) setState(() {});
  }

  @override
  Widget build(BuildContext context) {
    if (!widget.isLoading) return widget.child;

    final shimmer = Shimmer.of(context)!;
    if (!shimmer.isSized) return const SizedBox();

    final shimmerSize = shimmer.size;
    final gradient = shimmer.gradient;
    final offsetWithinShimmer =
        shimmer.getDescendantOffset(descendant: context.findRenderObject() as RenderBox);

    return ShaderMask(
      blendMode: BlendMode.srcATop,
      shaderCallback: (bounds) {
        return gradient.createShader(Rect.fromLTWH(
          -offsetWithinShimmer.dx,
          -offsetWithinShimmer.dy,
          shimmerSize.width,
          shimmerSize.height,
        ));
      },
      child: widget.child,
    );
  }
}




class TriangleListItem extends StatelessWidget {
  final bool isLoading;
  const TriangleListItem({super.key, required this.isLoading});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(8),
      child: ClipPath(
        clipper: _TriangleClipper(),
        child: Container(
          width: 54,
          height: 54,
          color: Colors.grey.shade900,
          child: isLoading
              ? null
              : const Center(
                  child: Icon(Icons.star, color: Colors.amber, size: 20),
                ),
        ),
      ),
    );
  }
}

class _TriangleClipper extends CustomClipper<Path> {
  @override
  Path getClip(Size size) {
    final path = Path()
      ..moveTo(size.width / 2, 0) 
      ..lineTo(0, size.height) 
      ..lineTo(size.width, size.height) 
      ..close();
    return path;
  }

  @override
  bool shouldReclip(covariant CustomClipper<Path> oldClipper) => false;
}

class CardListItem extends StatelessWidget {
  const CardListItem({super.key, required this.isLoading});
  final bool isLoading;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [_buildImage(), const SizedBox(height: 16), _buildText()],
      ),
    );
  }

  Widget _buildImage() {
    return AspectRatio(
      aspectRatio: 16 / 9,
      child: Container(
        decoration: BoxDecoration(
          color: Colors.grey.shade900,
          borderRadius: BorderRadius.circular(16),
        ),
        child: ClipRRect(
          borderRadius: BorderRadius.circular(16),
          child: Image.network(
            'https://picsum.photos/400/200',
            fit: BoxFit.cover,
          ),
        ),
      ),
    );
  }

  Widget _buildText() {
    if (isLoading) {
      return Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            width: double.infinity,
            height: 24,
            decoration: BoxDecoration(
              color: Colors.grey.shade900,
              borderRadius: BorderRadius.circular(16),
            ),
          ),
          const SizedBox(height: 16),
          Container(
            width: 200,
            height: 24,
            decoration: BoxDecoration(
              color: Colors.grey.shade900,
              borderRadius: BorderRadius.circular(16),
            ),
          ),
        ],
      );
    } else {
      return const Padding(
        padding: EdgeInsets.symmetric(horizontal: 8),
        child: Text(
          'Conteúdo carregado! Agora o shimmer sumiu.',
          style: TextStyle(color: Colors.white),
        ),
      );
    }
  }
}
