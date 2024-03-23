import { useQuery, gql } from "@apollo/client";
import Image  from 'next/image';

export default function Header() {
    const { data } = useQuery(Header.query);

    const customLogo = data?.customLogo ?? [];
    //const themeOptionsHeader = getThemeOptionsHeader(data);

    return (
        <header className="flex bg-header">
            <div className="container">
                <div>
                    { customLogo.url !== null &&(
                        <Image
                            className="w-auto"
                            src={customLogo.url}
                            alt={customLogo.description}
                            width={customLogo.width ?? 256}
                            height={customLogo.height ?? 79}
                        />
                    )}        
                </div>

                <div></div>

                <div></div>
            </div>
        </header>
    );
}

function getThemeOptionsHeader(data: any) {
    const themeOptionsHeader = data?.themeOptionsHeader ?? [];

    console.log(themeOptionsHeader);
}

Header.query = gql`
    {
        customLogo {
            description
            height
            url
            width
        }
        themeOptionsHeader {
            theme_options_header_categories_list
        }
    }
`;