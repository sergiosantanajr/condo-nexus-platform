
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import WhatsAppButton from "@/components/WhatsAppButton";
import { Button } from "@/components/ui/button";
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";

interface BlogPost {
  id: number;
  title: string;
  excerpt: string;
  content: string;
  author: string;
  date: string;
  image: string;
  category: string;
}

const BlogPage = () => {
  const [posts, setPosts] = useState<BlogPost[]>([]);
  const [loading, setLoading] = useState(true);
  
  useEffect(() => {
    // Simulando carregamento de posts do blog
    setTimeout(() => {
      setPosts([
        {
          id: 1,
          title: "Como gerenciar um condomínio de forma eficiente",
          excerpt: "Descubra as melhores práticas para uma administração condominial eficiente e transparente.",
          content: "Conteúdo completo do artigo aqui...",
          author: "Ana Silva",
          date: "15/05/2025",
          image: "https://images.unsplash.com/photo-1560518883-ce09059eeffa",
          category: "Administração"
        },
        {
          id: 2,
          title: "Direitos e deveres do síndico de condomínio",
          excerpt: "Conheça as responsabilidades legais e boas práticas para síndicos de condomínios residenciais.",
          content: "Conteúdo completo do artigo aqui...",
          author: "Carlos Mendes",
          date: "02/05/2025",
          image: "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab",
          category: "Legislação"
        },
        {
          id: 3,
          title: "Economia na manutenção do condomínio",
          excerpt: "Aprenda como reduzir custos sem comprometer a qualidade dos serviços condominiais.",
          content: "Conteúdo completo do artigo aqui...",
          author: "Marcos Oliveira",
          date: "28/04/2025",
          image: "https://images.unsplash.com/photo-1454165804606-c3d57bc86b40",
          category: "Finanças"
        },
        {
          id: 4,
          title: "Segurança condominial: as melhores práticas",
          excerpt: "Dicas importantes para garantir a segurança dos moradores e do patrimônio do condomínio.",
          content: "Conteúdo completo do artigo aqui...",
          author: "Juliana Martins",
          date: "15/04/2025",
          image: "https://images.unsplash.com/photo-1557804506-669a67965ba0",
          category: "Segurança"
        },
        {
          id: 5,
          title: "Como lidar com conflitos entre condôminos",
          excerpt: "Estratégias para resolução de conflitos e manutenção da harmonia no ambiente condominial.",
          content: "Conteúdo completo do artigo aqui...",
          author: "Pedro Santos",
          date: "05/04/2025",
          image: "https://images.unsplash.com/photo-1573497620053-ea5300f94f21",
          category: "Convivência"
        },
      ]);
      setLoading(false);
    }, 1000);
  }, []);

  return (
    <div className="min-h-screen flex flex-col">
      <Navbar />
      
      <main className="flex-grow pt-20 pb-16">
        <div className="container mx-auto px-4">
          <div className="text-center mb-12">
            <h1 className="text-3xl md:text-4xl font-bold mb-4 text-brand-blue">
              Blog da Nova Alternativa
            </h1>
            <div className="w-20 h-1 bg-brand-teal mx-auto mb-6"></div>
            <p className="text-xl text-gray-600 max-w-3xl mx-auto">
              Artigos, dicas e novidades sobre administração condominial e mercado imobiliário
            </p>
          </div>

          {loading ? (
            <div className="flex justify-center items-center py-20">
              <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-brand-blue"></div>
            </div>
          ) : (
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {posts.map((post) => (
                <div key={post.id} className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                  <div className="h-48 overflow-hidden">
                    <img 
                      src={post.image} 
                      alt={post.title}
                      className="w-full h-full object-cover transition-transform hover:scale-105 duration-300" 
                    />
                  </div>
                  <div className="p-6">
                    <div className="flex items-center mb-3">
                      <span className="bg-brand-blue/10 text-brand-blue text-xs px-3 py-1 rounded-full">
                        {post.category}
                      </span>
                      <span className="text-gray-400 text-xs ml-auto">
                        {post.date}
                      </span>
                    </div>
                    <h3 className="text-xl font-bold mb-2 text-gray-800 line-clamp-2">
                      {post.title}
                    </h3>
                    <p className="text-gray-600 mb-4 line-clamp-3">
                      {post.excerpt}
                    </p>
                    <div className="flex items-center justify-between">
                      <span className="text-sm text-gray-500">Por {post.author}</span>
                      <Link to={`/blog/${post.id}`}>
                        <Button variant="link" className="text-brand-blue p-0">
                          Ler mais
                        </Button>
                      </Link>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          )}

          <div className="mt-12 flex justify-center">
            <nav className="inline-flex rounded-md shadow">
              <Button variant="outline" className="rounded-l-md">
                Anterior
              </Button>
              <Button variant="outline" className="bg-brand-blue text-white hover:bg-brand-blue/80">
                1
              </Button>
              <Button variant="outline">
                2
              </Button>
              <Button variant="outline">
                3
              </Button>
              <Button variant="outline" className="rounded-r-md">
                Próximo
              </Button>
            </nav>
          </div>
        </div>
      </main>
      
      <Footer />
      <WhatsAppButton />
    </div>
  );
};

export default BlogPage;
